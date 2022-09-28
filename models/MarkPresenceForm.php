<?php

namespace app\models;

use yii\base\Model;

class MarkPresenceForm extends Model
{
    public array|string $studentsIds = '';

    public function rules(): array
    {
        return [
            [['studentsIds'], 'safe'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'studentsIds' => 'Студенты',
        ];
    }
}