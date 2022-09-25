<?php

namespace app\models;

use Yii;
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
    public static function tableName(): string
    {
        return 'file';
    }

    public function rules(): array
    {
        return [
            [['url'], 'string', 'max' => 2048],
            [['type'], 'string', 'max' => 16],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'type' => 'Type',
        ];
    }

    public function getLectureFiles(): ActiveQuery
    {
        return $this->hasMany(LectureFile::class, ['file_id' => 'id']);
    }
}
