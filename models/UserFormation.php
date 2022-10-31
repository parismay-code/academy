<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_formation".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $formation_id
 *
 * @property Formation $formation
 * @property User $user
 */
class UserFormation extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'user_formation';
    }

    public function rules(): array
    {
        return [
            [['user_id', 'formation_id'], 'integer'],
            [['user_id'], 'exist', 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['formation_id'], 'exist', 'targetClass' => Formation::class, 'targetAttribute' => ['formation_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'formation_id' => 'Формация',
        ];
    }

    public function getFormation(): ActiveQuery
    {
        return $this->hasOne(Formation::class, ['id' => 'formation_id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
