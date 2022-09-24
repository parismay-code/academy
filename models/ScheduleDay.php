<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "schedule_day".
 *
 * @property int $id
 * @property string|null $type
 * @property int|null $from
 * @property int|null $to
 *
 * @property DayLecture[] $dayLectures
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

    const DURATION_MAP = [
        self::TYPE_VACATION => 0,
        self::TYPE_LECTURE => 1,
        self::TYPE_ATTESTATION => 1,
        self::TYPE_EXAMINATION => 4
    ];

    const TYPE_MAP = [
        self::TYPE_VACATION => 'Выходной',
        self::TYPE_LECTURE => 'Лекции',
        self::TYPE_ATTESTATION => 'Аттестация',
        self::TYPE_EXAMINATION => 'Экзамен',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'schedule_day';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['type'], 'string', 'max' => 32],
            [['from', 'to'], 'integer'],
        ];
    }

    public function getDayLectures(): ActiveQuery
    {
        return $this->hasMany(DayLecture::class, ['day_id' => 'id']);
    }

    public function getDuration(): int
    {
        return self::DURATION_MAP[$this->type];
    }
}
