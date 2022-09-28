<?php

namespace app\controllers;

use app\models\DayLecture;
use app\models\User;
use Yii;
use yii\web\Controller;
use app\models\ScheduleDay;
use yii\web\Response;

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