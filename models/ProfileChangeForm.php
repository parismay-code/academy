<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\StaleObjectException;

class ProfileChangeForm extends Model
{
    public ?string $username = null;
    public ?int $fivemId = null;
    public ?string $discord = null;
    public ?int $formationId = null;
    public ?string $password = null;
    public ?string $newPassword = null;

    public function rules(): array
    {
        return [
            [['username', 'fivemId', 'discord', 'formationId', 'password'], 'required'],
            ['newPassword', 'string'],
            ['password', 'validatePass'],
        ];
    }

    public function validatePass($attribute) {
        if (!$this->hasErrors()) {
            $user = User::findOne(Yii::$app->user->id);

            if (!Yii::$app->security->validatePassword($this->password, $user->password)) {
                $this->addError($attribute, 'Неверный пароль');
            }
        }
    }

    public function edit(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $user = User::findOne(Yii::$app->user->id);

        $formationUser = FormationUser::findOne(['user_id' => $user->id]);

        $isUserUpdated = false;

        if ($this->username !== $user->username) {
            $user->username = $this->username;
            $isUserUpdated = true;
        }
        if ($this->fivemId !== $user->fivem_id) {
            $user->fivem_id = $this->fivemId;
            $isUserUpdated = true;
        }

        if ($this->discord !== $user->discord) {
            $user->discord = $this->discord;
            $isUserUpdated = true;
        }

        if ($this->newPassword && $this->newPassword !== $this->password) {
            $user->password = Yii::$app->security->generatePasswordHash($this->newPassword);
            $isUserUpdated = true;
        }

        if ($this->formationId !== $formationUser->formation_id) {
            $formationUser->formation_id = $this->formationId;

            $formationUser->update();
        }

        if ($isUserUpdated) {
            $user->update();
        }

        return true;
    }
}