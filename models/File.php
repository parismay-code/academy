<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $type
 *
 * @property LectureFile[] $lectureFiles
 */
class File extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['url'], 'string', 'max' => 2048],
            [['type'], 'string', 'max' => 16],
        ];
    }

    /**
     * Gets query for [[LectureFiles]].
     *
     * @return ActiveQuery
     */
    public function getLectureFiles(): ActiveQuery
    {
        return $this->hasMany(LectureFile::class, ['file_id' => 'id']);
    }
}
