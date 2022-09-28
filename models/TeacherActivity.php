<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "teacher_activity".
 *
 * @property int $id
 * @property int|null $teacher_id
 * @property string|null $type
 *
 * @property User $teacher
 */
class TeacherActivity extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'teacher_activity';
    }

    public function rules(): array
    {
        return [
            [['teacher_id'], 'integer'],
            [['type'], 'string', 'max' => 32],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'teacher_id' => 'Teacher ID',
            'type' => 'Type',
        ];
    }

    public function getTeacher(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'teacher_id']);
    }
}
