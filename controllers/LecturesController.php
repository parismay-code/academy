<?php

namespace app\controllers;

use app\models\Lecture;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;

class LecturesController extends Controller
{
    public function actionIndex(): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);
        $assistantStatusLevel = User::STATUS_MAP[User::STATUS_ASSISTANT]['level'];

        if (Yii::$app->user->isGuest || User::STATUS_MAP[$user->status]['level'] < $assistantStatusLevel) {
            return $this->goHome();
        }

        $models = Lecture::find()->all();

        return $this->render('index', [
            'models' => $models,
            'user' => $user
        ]);
    }

    public function actionView(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);
        $assistantStatusLevel = User::STATUS_MAP[User::STATUS_ASSISTANT]['level'];

        if (Yii::$app->user->isGuest || User::STATUS_MAP[$user->status]['level'] < $assistantStatusLevel) {
            return $this->goHome();
        }

        $model = Lecture::findOne($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionSubmit(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);
        $viceRectorStatusLevel = User::STATUS_MAP[User::STATUS_VICE_RECTOR]['level'];

        if (Yii::$app->user->isGuest || User::STATUS_MAP[$user->status]['level'] < $viceRectorStatusLevel) {
            return $this->goHome();
        }

        $model = Lecture::findOne($id);

        $model->status = Lecture::STATUS_SUBMITTED;

        $model->update();

        return $this->actionIndex();
    }

    public function actionZip(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);
        $viceRectorStatusLevel = User::STATUS_MAP[User::STATUS_VICE_RECTOR]['level'];

        if (Yii::$app->user->isGuest || User::STATUS_MAP[$user->status]['level'] < $viceRectorStatusLevel) {
            return $this->goHome();
        }

        $model = Lecture::findOne($id);

        $model->status = Lecture::STATUS_ARCHIVED;

        $model->update();

        return $this->actionIndex();
    }

    public function actionChange(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);
        $assistantStatusLevel = User::STATUS_MAP[User::STATUS_ASSISTANT]['level'];

        if (Yii::$app->user->isGuest || User::STATUS_MAP[$user->status]['level'] < $assistantStatusLevel) {
            return $this->goHome();
        }

        $model = Lecture::findOne($id);

        return $this->render('change', [
            'model' => $model
        ]);
    }
}