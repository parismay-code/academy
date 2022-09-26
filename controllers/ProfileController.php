<?php

namespace app\controllers;

use app\models\FormationUser;
use yii\helpers\Url;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use app\models\ProfileChangeForm;

class ProfileController extends Controller
{
    public function actionIndex(): Response|string
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('index');
    }

    public function actionEdit(): Response|string
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new ProfileChangeForm();
        if ($model->load(Yii::$app->request->post()) && $model->edit()) {
            Yii::$app->session->setFlash('success', 'Профиль успешно изменен.');

            return $this->redirect(Url::to(['profile/index']));
        }

        $user = User::findOne(Yii::$app->user->id);
        $formationId = FormationUser::findOne(['user_id' => $user->id])->formation_id;

        $model->username = $user->username;
        $model->fivemId = $user->fivem_id;
        $model->discord = $user->discord;
        $model->formationId = $formationId;
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function actionDelete(): Response
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = User::findOne(Yii::$app->user->id);

        $user->delete();

        Yii::$app->user->logout();

        Yii::$app->session->setFlash('success', "Профиль $user->username успешно удален");

        return $this->goHome();
    }
}