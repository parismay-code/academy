<?php

namespace app\controllers;

use app\models\FormationUser;
use yii\helpers\Url;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;

class ProfileController extends Controller
{
    public function actionIndex(): Response|string
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('index');
    }

    public function actionEdit(): Response|string
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = User::findOne(Yii::$app->user->id);
        $user->scenario = User::SCENARIO_EDIT;

        $formationUser = FormationUser::findOne(['user_id' => $user->id]);

        if (Yii::$app->request->getIsPost()) {
            $password = $user->password;

            $user->load(Yii::$app->request->post());

            if ($user->validate()) {
                if (Yii::$app->security->validatePassword($user->password, $password)) {
                    if ($user->new_password !== null) {
                        $user->password = Yii::$app->security->generatePasswordHash($user->new_password);
                    }

                    $user->update(false);

                    $formationUser->formation_id = $user->formation_id;

                    $formationUser->update(false);

                    Yii::$app->session->setFlash('success', 'Профиль успешно изменен.');

                    return $this->redirect(Url::to(['profile/index']));
                } else {
                    $user->addError('password', 'Неверный пароль');
                }
            }
        }

        $user->password = null;
        return $this->render('edit', [
            'user' => $user,
        ]);
    }

    public function actionDelete(): Response
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = User::findOne(Yii::$app->user->id);

        $user->delete();

        Yii::$app->user->logout();
        Yii::$app->session->setFlash('success', "Профиль $user->username успешно удален");

        return $this->goHome();
    }
}