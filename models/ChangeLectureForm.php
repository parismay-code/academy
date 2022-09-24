<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ChangeLectureForm extends Model
{
    public ?string $title = null;
    public ?string $details = null;

    public function rules(): array
    {
        return [
            [['title', 'details'], 'required'],
        ];
    }

    public function change(int $id): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $lecture = Lecture::findOne($id);

        $lecture->status = Lecture::STATUS_NEW;
        $lecture->title = $this->title;
        $lecture->details = $this->details;

        return $lecture->update();
    }

    public function create(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $lecture = new Lecture();

        $lecture->status = Lecture::STATUS_NEW;
        $lecture->creation_date = date("Y-m-d H:i:s", time());
        $lecture->title = $this->title;
        $lecture->details = $this->details;

        return $lecture->save();
    }
}