<?php

namespace app\models;

use yii\base\Model;

class ChangeScheduleDayForm extends Model
{
    public ?string $type = null;
    public ?int $from = null;
    public ?int $to = null;

    public function change(int $id): void
    {
        $scheduleDay = new ScheduleDay();

        $scheduleDay->id = $id;
        $scheduleDay->type = $this->type;
        $scheduleDay->from = $this->from;
        $scheduleDay->to = $this->to;

        $scheduleDay->save();

        for ($i = 0; $i < $this->to - $this->from; $i++) {
            $dayLecture = new DayLecture();

            $dayLecture->day_id = $id;
            $dayLecture->isFree = true;

            $dayLecture->save();
        }
    }
}