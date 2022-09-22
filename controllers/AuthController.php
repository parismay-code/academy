<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\helpers\Url;
use app\models\LoginForm;

class AuthController extends Controller
{
    public function actionIndex(): string|Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(Url::to(['schedule/index'], true));
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Url::to(['schedule/index'], true));
        }

        $model->password = '';
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}