<?php

namespace app\models;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'formation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'leader_name', 'deputy_leader_name', 'lawyer_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'name' => 'Формация',
            'leader_name' => 'Глава',
            'deputy_leader_name' => 'Первый заместитель (Примоген, Архонт, Легат)',
            'lawyer_name' => 'Второй заместитель (Хранитель, Юстициарий, Адъютор)',
        ];
    }

    /**
     * Gets query for [[FormationUsers]].
     *
     * @return ActiveQuery
     */
    public function getFormationUsers(): ActiveQuery
    {
        return $this->hasMany(FormationUser::class, ['formation_id' => 'id']);
    }
}
