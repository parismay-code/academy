<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;

class StudentsController extends Controller
{
    public function actionIndex(): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_VIEW_STUDENTS)) {
            return $this->goHome();
        }

        return $this->render('index');
    }
}