<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegistrationForm extends Model
{
    public ?int $fivemId = null;
    public ?string $username = null;
    public ?string $discord = null;
    public string $status = User::STATUS_VISITOR;
    public ?string $password = null;
    public ?string $repeatPassword = null;
    public ?int $formationId = null;

    public function rules(): array
    {
        return [
            [[
                'fivemId',
                'username',
                'discord',
                'status',
                'password',
                'repeatPassword',
                'formationId',
            ], 'required'],
            ['repeatPassword', 'compare', 'compareAttribute' => 'password'],
            ['fivemId', 'validateId']
        ];
    }

    public function validateId($attribute, $params): void
    {
        if (!$this->hasErrors()) {
            if (User::findOne(['fivem_id' => $this->fivemId])) {
                $this->addError($attribute, 'Аккаунт с данным ID уже существует.');
            }
        }
    }

    public function registration(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();

        $user->username = $this->username;
        $user->fivem_id = $this->fivemId;
        $user->discord = $this->discord;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->status = $this->status;
        $user->registration_date = date('Y.m.d H:i:s');
        $user->auth_key = Yii::$app->getSecurity()->generateRandomString();
        $user->access_token = Yii::$app->getSecurity()->generateRandomString();

        $user->save();

        $formationUser = new FormationUser();

        $formationUser->user_id = $user->id;
        $formationUser->formation_id = $this->formationId;

        $formationUser->save();

        return Yii::$app->user->login($user, 3600 * 24 * 30);
    }
}