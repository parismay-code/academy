<?php

namespace app\controllers;

use app\models\UserFormation;
use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\User;
use yii\helpers\Url;

class AuthController extends Controller
{
    public function actionIndex(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(Url::to(['schedule/index']));
        }

        $user = new User();
        $user->scenario = User::SCENARIO_LOGIN;

        if (Yii::$app->request->getIsPost()) {
            $user->load(Yii::$app->request->post());

            if ($user->validate()) {
                $_user = User::findOne(['fivem_id' => $user->fivem_id]);

                if (Yii::$app->security->validatePassword($user->password, $_user->password)) {
                    Yii::$app->user->login($_user, 3600 * 24 * 30);
                    Yii::$app->session->setFlash('success', "Вы вошли под именем $user->username.");

                    return $this->goHome();
                } else {
                    $user->addError('password', 'Неверный пароль.');
                }
            }
        }

        $user->password = '';
        return $this->render('index', [
            'user' => $user,
        ]);
    }

    public function actionRegistration(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = new User();
        $user->scenario = User::SCENARIO_REGISTRATION;

        $formationUser = new UserFormation();

        if (Yii::$app->request->getIsPost()) {
            $user->load(Yii::$app->request->post());

            if ($user->validate()) {
                $user->password = Yii::$app->security->generatePasswordHash($user->password);
                $user->registration_date = date('Y.m.d H:i:s');
                $user->auth_key = Yii::$app->getSecurity()->generateRandomString();
                $user->access_token = Yii::$app->getSecurity()->generateRandomString();

                $user->save(false);

                $formationUser->user_id = $user->id;
                $formationUser->formation_id = $user->formation_id;

                $formationUser->save(false);

                Yii::$app->user->login($user, 3600 * 24 * 30);
                Yii::$app->session->setFlash('success', 'Аккаунт успешно зарегистрирован.');

                return $this->goHome();
            }
        }

        $user->password = null;
        $user->password_repeat = null;
        return $this->render('registration', [
            'user' => $user,
        ]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('success', 'Вы вышли из аккаунта.');

        return $this->goHome();
    }
}