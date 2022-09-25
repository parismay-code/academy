<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use app\models\Lecture;
use app\models\ChangeLectureForm;
use yii\helpers\Url;

class LecturesController extends Controller
{
    public function actionIndex(): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_TAKE_LESSON)) {
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

        if (!$user || !$user->isActionAvailable(User::ACTION_TAKE_LESSON)) {
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

        if (!$user || !$user->isActionAvailable(User::ACTION_SUBMIT_LECTURE)) {
            return $this->goHome();
        }

        $model = Lecture::findOne($id);

        $model->status = Lecture::STATUS_SUBMITTED;

        $model->update();

        Yii::$app->session->setFlash('success', "Лекция #$id утверждена.");

        return $this->redirect(Url::to(['lectures/view', 'id' => $id]));
    }

    public function actionZip(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_ZIP_LECTURE)) {
            return $this->goHome();
        }

        $model = Lecture::findOne($id);

        $model->status = Lecture::STATUS_ARCHIVED;

        $model->update();

        Yii::$app->session->setFlash('success', "Лекция #$id архивирована.");

        return $this->redirect(Url::to(['lectures/view', 'id' => $id]));
    }

    public function actionChange(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_CHANGE_LECTURE)) {
            return $this->goHome();
        }

        $lecture = Lecture::findOne($id);

        $model = new ChangeLectureForm();
        if ($model->load(Yii::$app->request->post()) && $model->change($id)) {
            Yii::$app->session->setFlash('success', "Лекция #$id изменена.");

            return $this->redirect(Url::to(['lectures/view', 'id' => $id]));
        }

        $model->title = $lecture->title;
        $model->details = $lecture->details;

        return $this->render('change', [
            'model' => $model,
            'title' => 'Изменение лекции'
        ]);
    }

    public function actionCreate(): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_CREATE_LECTURE)) {
            return $this->goHome();
        }

        $model = new ChangeLectureForm();
        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            Yii::$app->session->setFlash('success', "Лекция '$model->title' успешно создана.");

            return $this->redirect(Url::to(['lectures/index']));
        }

        return $this->render('change', [
            'model' => $model,
            'title' => 'Новая лекция'
        ]);
    }

    public function actionDelete(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_DELETE_LECTURE)) {
            return $this->goHome();
        }

        $lecture = Lecture::findOne($id);

        $lecture->delete();

        Yii::$app->session->setFlash('success', "Лекция #$id удалена.");

        return $this->redirect(Url::to(['lectures/index']));
    }
}