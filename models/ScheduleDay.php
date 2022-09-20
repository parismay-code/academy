<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "schedule_day".
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $from
 * @property string|null $to
 *
 * @property DayLecture[] $dayLectures
 */
class ScheduleDay extends ActiveRecord
{
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
            [['type', 'from', 'to'], 'string', 'max' => 32],
        ];
    }

    /**
     * Gets query for [[DayLectures]].
     *
     * @return ActiveQuery
     */
    public function getDayLectures(): ActiveQuery
    {
        return $this->hasMany(DayLecture::class, ['day_id' => 'id']);
    }
}
