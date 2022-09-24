<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class LecturesController extends Controller
{
    public function actionIndex(): Response|string
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('index');
    }
}