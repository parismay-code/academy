<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lecture".
 *
 * @property int $id
 * @property string|null $status
 * @property string|null $creation_date
 * @property string|null $title
 * @property string|null $details
 *
 * @property DayLecture[] $dayLectures
 * @property LectureFile[] $lectureFiles
 */
class Lecture extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'lecture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['status', 'title', 'details'], 'string'],
            [['creation_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'status' => 'Статус',
            'creation_date' => 'Дата создания',
            'title' => 'Название',
            'details' => 'Материал',
        ];
    }

    /**
     * Gets query for [[DayLectures]].
     *
     * @return ActiveQuery
     */
    public function getDayLectures(): ActiveQuery
    {
        return $this->hasMany(DayLecture::class, ['lecture_id' => 'id']);
    }

    /**
     * Gets query for [[LectureFiles]].
     *
     * @return ActiveQuery
     */
    public function getLectureFiles(): ActiveQuery
    {
        return $this->hasMany(LectureFile::class, ['lecture_id' => 'id']);
    }
}
