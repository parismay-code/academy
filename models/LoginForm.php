<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public string $fivemId;
    public string $password;

    private bool|User $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            // username and password are both required
            [['fivemId', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword(string $attribute, array $params): void
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

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login(): User|bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->_user->id, 3600*24*30);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser(): User|null
    {
        if ($this->_user === false) {
            $this->_user = User::findOne(['fivem_id' => $this->fivemId]);
        }

        return $this->_user;
    }
}