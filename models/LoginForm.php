<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public ?int $fivemId = null;
    public ?string $password = null;

    private bool|User $_user = false;

    public function rules(): array
    {
        return [
            [['fivemId', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword(string $attribute): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user) {
                $this->addError($attribute, 'Пользователь с таким ID не найден.');
            }
            if (!$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный пароль');
            }
        }
    }

    public function login(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        return Yii::$app->user->login($this->getUser(), 3600*24*30);
    }

    public function getUser(): User|null
    {
        if ($this->_user === false) {
            $this->_user = User::findIdentityByFivemId($this->fivemId);
        }

        return $this->_user;
    }
}