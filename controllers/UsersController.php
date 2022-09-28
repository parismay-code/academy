<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use app\models\SearchUserForm;

class UsersController extends Controller
{
    public function actionIndex(): Response|string
    {
        $user = User::findOne(Yii::$app->user->id);

        if (!$user || !$user->isActionAvailable(User::ACTION_VIEW_ALL_USERS)) {
            return $this->goHome();
        }

        $models = User::find()
            ->joinWith('status')
            ->orderBy('status.level DESC')
            ->all();

        $formModel = new SearchUserForm();

        if (Yii::$app->request->getIsPost() && $formModel->load(Yii::$app->request->post()) && $formModel->validate()) {
            $models = User::find()
                ->joinWith('status')
                ->join('LEFT OUTER JOIN', 'formation_user', 'user_id = user.id');

            if ($formModel->search !== '') {
                $models = $models->andWhere("MATCH (username, discord) AGAINST ('$formModel->search')");
            }

            if (!empty($formModel->formationIds)) {
                $models = $models->andWhere(['formation_user.formation_id' => $formModel->formationIds]);
            }

            $models = $models->orderBy('status.level DESC')
                ->all();
        }

        return $this->render('index', [
            'models' => $models,
            'user' => $user,
            'formModel' => $formModel
        ]);
    }

    public function actionChange(int $id, int $newStatusId): Response
    {
        $user = User::findOne(Yii::$app->user->id);

        $targetUser = User::findOne($id);

        if (!$user || $user->status->level < $targetUser->status->level || $targetUser->status->id === $newStatusId) {
            return $this->goHome();
        }

        $targetUser->status_id = $newStatusId;
        $targetUser->update();

        Yii::$app->session->setFlash(
            'success',
            "Cтатус $targetUser->username успешно изменен на " . "'" . $targetUser->status->label . "'."
        );

        return $this->redirect(Url::to(['users/index']));
    }
}