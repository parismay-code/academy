<?php

namespace app\controllers;

use Yii;
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
}