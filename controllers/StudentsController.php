<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use app\models\Formation;

class StudentsController extends Controller
{
    public function actionIndex(int $formation_id = 1): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_VIEW_STUDENTS)) {
            return $this->goHome();
        }

        $formations = Formation::find()->all();

        $models = User::find()
            ->where(['formation_id' => $formation_id])
            ->andWhere(['status_id' => 0])
            ->orderBy('id DESC')
            ->all();

        return $this->render('index', [
            'formations' => $formations,
            'targetFormationId' => $formation_id,
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

        return $this->redirect(Url::to(['students/index']));
    }
}