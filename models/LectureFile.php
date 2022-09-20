<?php

namespace app\models;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'lecture_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['lecture_id', 'file_id'], 'integer'],
            [
                ['lecture_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Lecture::class,
                'targetAttribute' => ['lecture_id' => 'id']
            ],
            [
                ['file_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => File::class,
                'targetAttribute' => ['file_id' => 'id']
            ],
        ];
    }

    /**
     * Gets query for [[File]].
     *
     * @return ActiveQuery
     */
    public function getFile(): ActiveQuery
    {
        return $this->hasOne(File::class, ['id' => 'file_id']);
    }

    /**
     * Gets query for [[Lecture]].
     *
     * @return ActiveQuery
     */
    public function getLecture(): ActiveQuery
    {
        return $this->hasOne(Lecture::class, ['id' => 'lecture_id']);
    }
}
