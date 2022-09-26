<?php

namespace app\controllers;

use app\models\Status;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use app\models\TeacherQueue;

class TeachersController extends Controller
{
    public function actionIndex(): Response|string
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $teachersStatusesId = [
            Status::findOne(['name' => Status::ASSISTANT])->id,
            Status::findOne(['name' => Status::TEACHER])->id,
            Status::findOne(['name' => Status::MASTER])->id,
            Status::findOne(['name' => Status::DEAN])->id,
            Status::findOne(['name' => Status::VICE_RECTOR])->id,
            Status::findOne(['name' => Status::RECTOR])->id,
        ];

        $models = User::find()
            ->where(['user.status_id' => $teachersStatusesId])
            ->join('LEFT OUTER JOIN', 'status', 'status.id = user.status_id')
            ->orderBy('status.level DESC')
            ->all();

        return $this->render('index', [
            'models' => $models
        ]);
    }

    public function actionQueue(): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_CHANGE_ASSISTANT)) {
            return $this->goHome();
        }

        $models = TeacherQueue::find()
            ->orderBy('id ASC')
            ->all();

        return $this->render('queue', [
            'models' => $models,
            'user' => $user
        ]);
    }

    public function actionRequest(int $id): Response
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || ($user->status->name !== Status::VISITOR && $user->status->name !== STATUS::STUDENT)) {
            return $this->goHome();
        }

        $model = new TeacherQueue();
        $model->user_id = $id;
        $model->save();

        Yii::$app->session->setFlash('success', 'Ваша заявка принята к рассмотрению.');

        return $this->redirect(Url::to(['teachers/index']));
    }

    public function actionAccept(int $id): Response
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_CHANGE_ASSISTANT)) {
            return $this->goHome();
        }

        $model = TeacherQueue::findOne($id);
        $userModel = $model->user;

        $model->delete();

        $status = Status::findOne(['level' => 2]);

        $userModel->status_id = $status->id;
        $userModel->update();

        Yii::$app->session->setFlash(
            'success',
            "$userModel->username успешно принят(а) в преподавательский состав на должность '$status->label'."
        );

        return $this->redirect(Url::to(['teachers/index']));
    }

    public function actionDecline(int $id): Response
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_CHANGE_ASSISTANT)) {
            return $this->goHome();
        }

        $model = TeacherQueue::findOne($id);
        $model->delete();

        Yii::$app->session->setFlash('success', "Заявка #$model->id отклонена.");

        return $this->redirect(Url::to(['teachers/index']));
    }

    public function actionChange(int $id, int $newStatusId): Response
    {
        $user = User::findOne(Yii::$app->user->id);

        $targetUser = User::findOne($id);

        if (!$user || $user->status->level < $targetUser->status->level || $targetUser->status->id === $newStatusId) {
            return $this->goHome();
        }

        $targetUser->status_id = $newStatusId;
        $targetUser->update();

        Yii::$app->session->setFlash(
            'success',
            "Cтатус $targetUser->username успешно изменен на " . "'" . $targetUser->status->label . "'."
        );

        return $this->redirect(Url::to(['teachers/index']));
    }
}