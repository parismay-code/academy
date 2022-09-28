<?php

namespace app\models;

use yii\base\Model;

class SearchUserForm extends Model
{
    public string $formationId = '';
    public string $search = '';

    public function rules(): array
    {
        return [
            [['formationId', 'search'], 'string'],
            [['formationId'], 'exist', 'targetClass' => Formation::class, 'targetAttribute' => ['formationId' => 'id']],
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