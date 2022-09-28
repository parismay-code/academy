<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "day_lecture".
 *
 * @property int $id
 * @property int|null $day_id
 * @property int|null $lecture_id
 * @property int|null $teacher_id
 * @property int|null $time
 * @property int|null $is_free
 *
 * @property ScheduleDay $day
 * @property Lecture $lecture
 * @property User $teacher
 */
class DayLecture extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'day_lecture';
    }

    public function rules(): array
    {
        return [
            [['day_id', 'lecture_id', 'teacher_id', 'time', 'is_free'], 'integer'],
            [['day_id'], 'exist', 'targetClass' => ScheduleDay::class, 'targetAttribute' => ['day_id' => 'id']],
            [['lecture_id'], 'exist', 'targetClass' => Lecture::class, 'targetAttribute' => ['lecture_id' => 'id']],
            [['teacher_id'], 'exist', 'targetClass' => User::class, 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'day_id' => 'Day ID',
            'lecture_id' => 'Лекция',
            'teacher_id' => 'Преподаватель',
            'time' => 'Time',
            'is_free' => 'Статус лекции',
        ];
    }

    public function getDay(): ActiveQuery
    {
        return $this->hasOne(ScheduleDay::class, ['id' => 'day_id']);
    }

    public function getLecture(): ActiveQuery
    {
        return $this->hasOne(Lecture::class, ['id' => 'lecture_id']);
    }

    public function getTeacher(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'teacher_id']);
    }
}
