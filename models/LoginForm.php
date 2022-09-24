<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public ?int $fivemId = null;
    public ?string $password = null;

    private User|bool $_user = false;

    public function rules(): array
    {
        return [
            [['fivemId', 'password'], 'required'],
            [['fivemId', 'password'], 'validateData'],
        ];
    }

    public function validateData(): void
    {
        if ($this->hasErrors()) {
            return;
        }

        $this->_user = User::findOne(['fivem_id' => $this->fivemId]) ?? false;

        if ($this->_user === false) {
            $this->addError('fivemId', 'Указанный ID не зарегистрирован.');
        } else if (!$this->_user->validatePassword($this->password)) {
            $this->addError('password', 'Неверный пароль.');
        }
    }

    public function login(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        return Yii::$app->user->login($this->_user, 3600 * 24 * 30);
    }
}