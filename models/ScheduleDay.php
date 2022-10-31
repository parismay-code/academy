<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "schedule_day".
 *
 * @property int $id
 * @property string|null $type
 * @property int|null $day
 * @property int|null $evening
 *
 * @property ScheduleDayLecture[] $scheduleDayLectures
 */
class ScheduleDay extends ActiveRecord
{
    const DAYS_MAP = [
        1 => ['en' => 'Monday', 'ru' => 'Понедельник'],
        2 => ['en' => 'Tuesday', 'ru' => 'Вторник'],
        3 => ['en' => 'Wednesday', 'ru' => 'Среда'],
        4 => ['en' => 'Thursday', 'ru' => 'Четверг'],
        5 => ['en' => 'Friday', 'ru' => 'Пятница'],
        6 => ['en' => 'Saturday', 'ru' => 'Суббота'],
        7 => ['en' => 'Sunday', 'ru' => 'Воскресенье']
    ];

    const TYPE_VACATION = 'vacation';
    const TYPE_LECTURE = 'lecture';
    const TYPE_ATTESTATION = 'attestation';
    const TYPE_EXAMINATION = 'examination';

    const TYPE_MAP = [
        self::TYPE_VACATION => 'Выходной',
        self::TYPE_LECTURE => 'Лекции',
        self::TYPE_ATTESTATION => 'Аттестация',
        self::TYPE_EXAMINATION => 'Экзамен',
    ];

    public static function tableName(): string
    {
        return 'schedule_day';
    }

    public function rules(): array
    {
        return [
            [['day', 'evening'], 'integer'],
            [['type'], 'string', 'max' => 32],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'type' => 'Тип дня',
            'day' => 'Начало дневной группы',
            'evening' => 'Начало вечерней группы',
        ];
    }

    public function getScheduleDayLectures(): ActiveQuery
    {
        return $this->hasMany(ScheduleDayLecture::class, ['day_id' => 'id']);
    }
}