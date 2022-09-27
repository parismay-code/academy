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

        $lectures = Lecture::find()->all();

        return $this->render('index', [
            'lectures' => $lectures,
            'user' => $user
        ]);
    }

    public function actionView(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_TAKE_LESSON)) {
            return $this->goHome();
        }

        $lecture = Lecture::findOne($id);

        return $this->render('view', [
            'lecture' => $lecture
        ]);
    }

    public function actionSubmit(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_SUBMIT_LECTURE)) {
            return $this->goHome();
        }

        $lecture = Lecture::findOne($id);

        $lecture->status = Lecture::STATUS_SUBMITTED;

        $lecture->update();

        Yii::$app->session->setFlash('success', "Лекция #$id утверждена.");

        return $this->redirect(Url::to(['lectures/view', 'id' => $id]));
    }

    public function actionZip(int $id): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_ZIP_LECTURE)) {
            return $this->goHome();
        }

        $lecture = Lecture::findOne($id);

        $lecture->status = Lecture::STATUS_ARCHIVED;

        $lecture->update();

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

        if (Yii::$app->request->getIsPost()) {
            $lecture->load(Yii::$app->request->post());

            if ($lecture->validate()) {
                $lecture->status = Lecture::STATUS_NEW;
                $lecture->update(false);

                Yii::$app->session->setFlash('success', "Лекция '$lecture->title' успешно изменена.");

                return $this->redirect(Url::to(['lectures/view', 'id' => $lecture->id]));
            }
        }

        return $this->render('change', [
            'lecture' => $lecture,
            'title' => 'Изменение лекции'
        ]);
    }

    public function actionCreate(): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_CREATE_LECTURE)) {
            return $this->goHome();
        }

        $lecture = new Lecture();

        if (Yii::$app->request->getIsPost()) {
            $lecture->load(Yii::$app->request->post());

            if ($lecture->validate()) {
                $lecture->status = Lecture::STATUS_NEW;
                $lecture->save(false);

                Yii::$app->session->setFlash('success', "Лекция '$lecture->title' успешно создана.");

                return $this->redirect(Url::to(['lectures/view', 'id' => $lecture->id]));
            }
        }

        return $this->render('change', [
            'lecture' => $lecture,
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