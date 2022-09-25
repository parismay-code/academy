<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "student_visit".
 *
 * @property int $id
 * @property int|null $student_id
 * @property int|null $lecture_id
 * @property int|null $is_individual
 *
 * @property Lecture $lecture
 * @property User $student
 */
class StudentVisit extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'student_visit';
    }

    public function rules(): array
    {
        return [
            [['student_id', 'lecture_id', 'is_individual'], 'integer'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['student_id' => 'id']],
            [['lecture_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lecture::class, 'targetAttribute' => ['lecture_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'lecture_id' => 'Lecture ID',
            'is_individual' => 'Is Individual',
        ];
    }

    public function getLecture(): ActiveQuery
    {
        return $this->hasOne(Lecture::class, ['id' => 'lecture_id']);
    }

    public function getStudent(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'student_id']);
    }
}
