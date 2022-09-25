<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "teacher_queue".
 *
 * @property int $id
 * @property int|null $user_id
 *
 * @property User $user
 */
class TeacherQueue extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'teacher_queue';
    }

    public function rules(): array
    {
        return [
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
        ];
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
