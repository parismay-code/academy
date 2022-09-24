<?php

namespace app\models;

use yii\base\Model;

class ChangeScheduleDayForm extends Model
{
    public ?string $type = null;
    public ?int $from = null;
    public ?int $to = null;

    public function rules(): array
    {
        return [
            [['type', 'from', 'to'], 'required'],
        ];
    }

    public function change(int $id): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $scheduleDay = ScheduleDay::findOne($id);

        $scheduleDay->type = $this->type;
        $scheduleDay->from = $this->from;
        $scheduleDay->to = $this->to;

        $dayLectures = $scheduleDay->dayLectures;

        foreach ($dayLectures as $lecture) {
            $lecture->delete();
        }

        for ($i = 0; $i < $this->to - $this->from; $i++) {
            $lecture = new DayLecture();

            $lecture->day_id = $id;
            $lecture->time = $this->from + $i;
            $lecture->isFree = 1;

            $lecture->save();
        }

        return $scheduleDay->update();
    }
}