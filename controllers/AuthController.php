<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\RegistrationForm;
use app\models\User;
use yii\helpers\Url;

class AuthController extends Controller
{
    public function actionIndex(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(Url::to(['schedule/index']));
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionRegistration(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegistrationForm();
        if ($model->load(Yii::$app->request->post()) && $model->registration()) {
            Yii::$app->session->setFlash('success', 'Аккаунт успешно зарегистрирован.');

            return $this->goHome();
        }

        $model->password = null;
        $model->repeatPassword = null;
        return $this->render('registration', [
            'model' => $model,
        ]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        Yii::$app->session->setFlash('success', 'Вы вышли из аккаунта.');

        return $this->goHome();
    }
}