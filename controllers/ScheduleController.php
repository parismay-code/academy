<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\ScheduleDay;
use app\models\DayLecture;
use app\models\User;
use app\models\TeacherActivity;
use app\models\StudentVisit;
use app\models\MarkPresenceForm;
use yii\helpers\Url;

class ScheduleController extends Controller
{
    public function actionIndex(): Response|string
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $schedules = ScheduleDay::find()->all();

        return $this->render('index', ['schedules' => $schedules]);
    }

    public function actionPresence(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_TAKE_LESSON)) {
            return $this->goHome();
        }

        $dayLecture = DayLecture::findOne($id);

        $dayData = ScheduleDay::DAYS_MAP[$dayLecture->day_id];

        $timestamp = strtotime($dayData['en']);

        if ($timestamp > strtotime('Sunday')) {
            $timestamp = strtotime('-1 week', $timestamp);
        }

        $date = date('d.m.Y', $timestamp);

        $isScheduleToday = $date === date("d.m.Y", time());

        $lectureTimestamp = strtotime("$dayLecture->time:00");

        $diff = time() - $lectureTimestamp;

        if ($diff < 0) {
            $diff *= -1;
            $diff /= 60;
            $diff *= -1;
        } else {
            $diff /= 60;
        }

//        if ($diff > 60 || $diff < -10 || !$isScheduleToday) {
//            return $this->goHome();
//        }

        $formModel = new MarkPresenceForm();

        if (Yii::$app->request->getIsPost()) {
            $formModel->load(Yii::$app->request->post());

            if ($formModel->validate() && $formModel->studentsIds !== '') {
                foreach ($formModel->studentsIds as $studentId) {
                    $studentVisit = new StudentVisit();

                    $studentVisit->student_id = (int)$studentId;
                    $studentVisit->lecture_id = $id;
                    $studentVisit->is_individual = 0;
                    $studentVisit->date = date('Y.m.d H:i:s');

                    $studentVisit->save();
                }

                $teacherActivity = new TeacherActivity();

                $teacherActivity->teacher_id = (int)$dayLecture->teacher_id;
                $teacherActivity->type = ScheduleDay::TYPE_LECTURE;
                $teacherActivity->date = date('Y.m.d H:i:s');

                $teacherActivity->save();

                return $this->redirect(Url::to(['schedule/index']));
            }
        }

        return $this->render('presence', [
            'formModel' => $formModel,
            'dayLecture' => $dayLecture
        ]);
    }

    public function actionVacate(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_TAKE_LESSON)) {
            return $this->goHome();
        }

        $dayLecture = DayLecture::findOne($id);

        $dayLecture->is_free = 1;

        $dayLecture->update();

        Yii::$app->session->setFlash('success', "Лекция на $dayLecture->time:00 освобождена.");

        return $this->goHome();
    }

    public function actionAppoint(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_TAKE_LESSON)) {
            return $this->goHome();
        }

        $dayLecture = DayLecture::findOne($id);
        $schedule = $dayLecture->day;

        $dayLecture->teacher_id = $dayLecture->teacher_id ?? $user->id;

        if (Yii::$app->request->getIsPost()) {
            $dayLecture->load(Yii::$app->request->post());

            if ($dayLecture->validate()) {
                $dayLecture->is_free = 0;
                $dayLecture->update(false);

                Yii::$app->session->setFlash('success', "На $dayLecture->time:00 назначения лекция '" . $dayLecture->lecture->title . "'.");

                return $this->goHome();
            }
        }

        return $this->render('changeLecture', [
            'dayLecture' => $dayLecture,
            'schedule' => $schedule
        ]);
    }

    public function actionChange(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_CHANGE_SCHEDULE)) {
            return $this->goHome();
        }

        $schedule = ScheduleDay::findOne($id);

        if (Yii::$app->request->getIsPost()) {
            $schedule->load(Yii::$app->request->post());

            if ($schedule->validate()) {
                foreach ($schedule->dayLectures as $lecture) {
                    $lecture->delete();
                }

                for ($i = 0; $i < $schedule->to - $schedule->from; $i++) {
                    $lecture = new DayLecture();

                    $lecture->day_id = $id;
                    $lecture->time = $schedule->from + $i;
                    $lecture->is_free = 1;

                    $lecture->save();
                }

                $schedule->update(false);

                Yii::$app->session->setFlash('success', 'Расписание изменено.');

                return $this->goHome();
            }
        }

        return $this->render('changeDay', ['schedule' => $schedule]);
    }
}