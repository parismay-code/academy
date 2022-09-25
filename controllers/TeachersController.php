<?php

namespace app\controllers;

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

        $models = User::findAll([
            'status' => [
                User::STATUS_ASSISTANT,
                User::STATUS_TEACHER,
                User::STATUS_MASTER,
                User::STATUS_DEAN,
                User::STATUS_VICE_RECTOR,
                User::STATUS_RECTOR,
            ]
        ]);

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

        $models = TeacherQueue::find()->all();

        return $this->render('queue', [
            'models' => $models,
            'user' => $user
        ]);
    }

    public function actionRequest(int $id): Response
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || ($user->status !== User::STATUS_VISITOR && $user->status !== User::STATUS_STUDENT)) {
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

        $userModel->status = User::STATUS_ASSISTANT;
        $userModel->update();

        Yii::$app->session->setFlash('success', "$userModel->username успешно принят(а) в преподавательский состав на должность 'Ассистент'.");

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

    public function actionChange(int $id, string $newStatus): Response
    {
        $user = User::findOne(Yii::$app->user->id);

        $targetUser = User::findOne($id);

        if (!$user || !$user->isChangeUserStatusAvailable($targetUser->status) || $targetUser->status === $newStatus) {
            return $this->goHome();
        }

        $targetUser->status = $newStatus;
        $targetUser->update();

        Yii::$app->session->setFlash(
            'success',
            "Cтатус $targetUser->username успешно изменен на " . "'" . User::STATUS_MAP[$newStatus]['name'] . "'."
        );

        return $this->redirect(Url::to(['teachers/index']));
    }
}