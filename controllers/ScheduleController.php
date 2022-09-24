<?php

namespace app\controllers;

use app\models\DayLecture;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use app\models\ScheduleDay;
use app\models\ChangeLectureForm;
use app\models\ChangeScheduleDayForm;
use yii\web\Response;

class ScheduleController extends Controller
{
    public function actionIndex(): Response|string
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $models = ScheduleDay::find()->all();

        return $this->render('index', ['models' => $models]);
    }

    public function actionChange(string $type, int $id): Response|string
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $dayLecture = null;
        $scheduleDay = null;

        $model = $type === 'lecture' ? new ChangeLectureForm() : new ChangeScheduleDayForm();

        if ($type === 'lecture') {
            $dayLecture = DayLecture::findOne($id);
            $scheduleDay = $dayLecture->day;

            $model->lectureId = $dayLecture->lecture_id;
            $model->teacherId = $dayLecture->teacher_id;
            $model->time = $dayLecture->time;
        } else {
            $scheduleDay = ScheduleDay::findOne($id);

            $model->type = $scheduleDay->type;
            $model->from = $scheduleDay->from;
            $model->to = $scheduleDay->to;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($type === 'lecture') {
                $dayLecture->delete();
            } else {
                foreach ($scheduleDay->dayLectures as $lecture) {
                    $lecture->delete();
                }

                $scheduleDay->delete();
            }

            $model->change($id);

            return $this->goBack();
        }

        return $this->render($type === 'lecture' ? 'changeLecture' : 'changeDay', [
            'model' => $model,
            'dayLecture' => $dayLecture,
            'scheduleDay' => $scheduleDay
        ]);
    }
}