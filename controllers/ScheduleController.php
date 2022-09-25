<?php

namespace app\controllers;

use app\models\DayLecture;
use app\models\User;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use app\models\ScheduleDay;
use app\models\ChangeDayLectureForm;
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
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable($type === 'lecture' ? User::ACTION_TAKE_LESSON : User::ACTION_CHANGE_SCHEDULE)) {
            return $this->goHome();
        }

        $dayLecture = null;
        $scheduleDay = null;

        $model = $type === 'lecture' ? new ChangeDayLectureForm() : new ChangeScheduleDayForm();

        if ($type === 'lecture') {
            $dayLecture = DayLecture::findOne($id);
            $scheduleDay = $dayLecture->day;

            $model->lectureId = $dayLecture->lecture_id;
            $model->teacherId = $dayLecture->teacher_id;
            $model->isFree = (bool)$dayLecture->is_free;
        } else {
            $scheduleDay = ScheduleDay::findOne($id);

            $model->type = $scheduleDay->type;
            $model->from = $scheduleDay->from;
            $model->to = $scheduleDay->to;
        }

        if ($model->load(Yii::$app->request->post()) && $model->change($id)) {
            return $this->goHome();
        }

        return $this->render($type === 'lecture' ? 'changeLecture' : 'changeDay', [
            'model' => $model,
            'dayLecture' => $dayLecture,
            'scheduleDay' => $scheduleDay
        ]);
    }
}