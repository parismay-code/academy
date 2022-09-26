<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;

class UsersController extends Controller
{
    public function actionIndex(): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_VIEW_ALL_USERS)) {
            return $this->goHome();
        }

        $models = User::find()->all();

        return $this->render('index', [
            'models' => $models,
            'user' => $user
        ]);
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

        return $this->redirect(Url::to(['users/index']));
    }
}