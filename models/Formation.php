<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "formation".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $leader_name
 * @property string|null $deputy_leader_name
 * @property string|null $lawyer_name
 *
 * @property FormationUser[] $formationUsers
 */
class Formation extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'formation';
    }

    public function rules(): array
    {
        return [
            [['name', 'leader_name', 'deputy_leader_name', 'lawyer_name'], 'string', 'max' => 128],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Название формации',
            'leader_name' => 'Глава (Виконт, Понтифик, Лорд)',
            'deputy_leader_name' => 'Первый заместитель (Легат, Архонт, Примоген)',
            'lawyer_name' => 'Второй заместитель (Адъютор, Юстициарий, Хранитель)',
        ];
    }

    public function getFormationUsers(): ActiveQuery
    {
        return $this->hasMany(FormationUser::class, ['formation_id' => 'id']);
    }
}
