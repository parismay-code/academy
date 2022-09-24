<?php

namespace app\models;

use yii\base\Model;
use yii\db\StaleObjectException;

class ChangeLectureForm extends Model
{
    public ?int $lectureId = null;
    public ?int $teacherId = null;
    public ?int $time = null;

    public function change(int $id): bool
    {
        $dayLecture = new DayLecture();

        $isFree = !isset($this->lectureId, $this->teacherId, $this->time);

        $dayLecture->id = $id;
        $dayLecture->lecture_id = $this->lectureId;
        $dayLecture->teacher_id = $this->teacherId;
        $dayLecture->time = $this->time;
        $dayLecture->isFree = $isFree;

        return $dayLecture->save();
    }
}