<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lecture_file".
 *
 * @property int $id
 * @property int|null $lecture_id
 * @property int|null $file_id
 *
 * @property File $file
 * @property Lecture $lecture
 */
class LectureFile extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'lecture_file';
    }

    public function rules(): array
    {
        return [
            [['lecture_id', 'file_id'], 'integer'],
            [['lecture_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lecture::class, 'targetAttribute' => ['lecture_id' => 'id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::class, 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'lecture_id' => 'Lecture ID',
            'file_id' => 'File ID',
        ];
    }

    public function getFile(): ActiveQuery
    {
        return $this->hasOne(File::class, ['id' => 'file_id']);
    }

    public function getLecture(): ActiveQuery
    {
        return $this->hasOne(Lecture::class, ['id' => 'lecture_id']);
    }
}
