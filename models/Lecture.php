<?php

namespace app\models;

use Yii;
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
 * @property StudentVisit[] $studentVisits
 */
class Lecture extends ActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_SUBMITTED = 'submitted';
    const STATUS_ARCHIVED = 'archived';

    public static function tableName(): string
    {
        return 'lecture';
    }

    public function rules(): array
    {
        return [
            [['title', 'details'], 'required'],
            [['status', 'title', 'details'], 'string'],
            [['creation_date'], 'safe'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'creation_date' => 'Creation Date',
            'title' => 'Название лекции',
            'details' => 'Лекционный материал',
        ];
    }

    public function getDayLectures(): ActiveQuery
    {
        return $this->hasMany(DayLecture::class, ['lecture_id' => 'id']);
    }

    public function getLectureFiles(): ActiveQuery
    {
        return $this->hasMany(LectureFile::class, ['lecture_id' => 'id']);
    }

    public function getStudentVisits(): ActiveQuery
    {
        return $this->hasMany(StudentVisit::class, ['lecture_id' => 'id']);
    }
}
