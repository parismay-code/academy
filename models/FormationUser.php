<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "formation_user".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $formation_id
 *
 * @property Formation $formation
 * @property User $user
 */
class FormationUser extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'formation_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'formation_id'], 'integer'],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id']
            ],
            [
                ['formation_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Formation::class,
                'targetAttribute' => ['formation_id' => 'id']
            ],
        ];
    }

    /**
     * Gets query for [[Formation]].
     *
     * @return ActiveQuery
     */
    public function getFormation(): ActiveQuery
    {
        return $this->hasOne(Formation::class, ['id' => 'formation_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
