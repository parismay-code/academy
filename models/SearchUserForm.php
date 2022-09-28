<?php

namespace app\models;

use yii\base\Model;

class SearchUserForm extends Model
{
    public array|string $formationIds = '';
    public string $search = '';

    public function rules(): array
    {
        return [
            ['search', 'string'],
            [['formationIds'], 'safe'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'formationId' => 'Формация',
            'search' => 'Поисковой запрос'
        ];
    }
}