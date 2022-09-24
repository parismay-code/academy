<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use app\models\Lecture;
use app\models\ChangeLectureForm;

class LecturesController extends Controller
{
    private function checkUserRights(User $user, string $minimalStatus): bool
    {
        $minimalStatusLevel = User::STATUS_MAP[$minimalStatus]['level'];

        return User::STATUS_MAP[$user->status]['level'] >= $minimalStatusLevel;
    }

    public function actionIndex(): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$this->checkUserRights($user, User::STATUS_ASSISTANT)) {
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

        if (!$this->checkUserRights($user, User::STATUS_ASSISTANT)) {
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

        if (!$this->checkUserRights($user, User::STATUS_VICE_RECTOR)) {
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

        if (!$this->checkUserRights($user, User::STATUS_MASTER)) {
            return $this->goHome();
        }

        $lecture = Lecture::findOne($id);

        $model = new ChangeLectureForm();
        if ($model->load(Yii::$app->request->post()) && $model->change($id)) {
            return $this->actionView($id);
        }

        $model->title = $lecture->title;
        $model->details = $lecture->details;

        return $this->render('change', [
            'model' => $model
        ]);
    }

    public function actionCreate(): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$this->checkUserRights($user, User::STATUS_MASTER)) {
            return $this->goHome();
        }

        $model = new ChangeLectureForm();
        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            return $this->actionIndex();
        }

        return $this->render('change', [
            'model' => $model
        ]);
    }

    public function actionDelete(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$this->checkUserRights($user, User::STATUS_VICE_RECTOR)) {
            return $this->goHome();
        }

        $lecture = Lecture::findOne($id);

        $lecture->delete();

        return $this->actionIndex();
    }
}