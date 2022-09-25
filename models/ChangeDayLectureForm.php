<?php

namespace app\models;

use yii\base\Model;
use yii\db\StaleObjectException;

class ChangeDayLectureForm extends Model
{
    public ?int $lectureId = null;
    public ?int $teacherId = null;
    public bool $isFree = true;

    public function rules(): array
    {
        return [
            [['lectureId', 'teacherId'], 'integer'],
            ['isFree', 'boolean']
        ];
    }

    public function change(int $id): bool
    {
        if ($this->hasErrors()) {
            return false;
        }

        $dayLecture = DayLecture::findOne($id);

        if (!$this->isFree) {
            $dayLecture->lecture_id = $this->lectureId;
            $dayLecture->teacher_id = $this->teacherId;
        }

        $dayLecture->is_free = (int)$this->isFree;

        return $dayLecture->update();
    }
}