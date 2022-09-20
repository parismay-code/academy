<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "day_lecture".
 *
 * @property int $id
 * @property int|null $day_id
 * @property int|null $lecture_id
 * @property int|null $teacher_id
 * @property string|null $time
 *
 * @property ScheduleDay $day
 * @property Lecture $lecture
 * @property User $teacher
 */
class DayLecture extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'day_lecture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['day_id', 'lecture_id', 'teacher_id'], 'integer'],
            [['time'], 'string', 'max' => 32],
            [
                ['day_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => ScheduleDay::class,
                'targetAttribute' => ['day_id' => 'id']
            ],
            [
                ['lecture_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Lecture::class,
                'targetAttribute' => ['lecture_id' => 'id']
            ],
            [
                ['teacher_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['teacher_id' => 'id']
            ],
        ];
    }

    /**
     * Gets query for [[Day]].
     *
     * @return ActiveQuery
     */
    public function getDay(): ActiveQuery
    {
        return $this->hasOne(ScheduleDay::class, ['id' => 'day_id']);
    }

    /**
     * Gets query for [[Lecture]].
     *
     * @return ActiveQuery
     */
    public function getLecture(): ActiveQuery
    {
        return $this->hasOne(Lecture::class, ['id' => 'lecture_id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return ActiveQuery
     */
    public function getTeacher(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'teacher_id']);
    }
}
