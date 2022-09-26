<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $label
 * @property int|null $level
 *
 * @property User[] $users
 */
class Status extends ActiveRecord
{
    const VISITOR = 'visitor';
    const STUDENT = 'student';
    const ASSISTANT = 'assistant';
    const TEACHER = 'teacher';
    const MASTER = 'master';
    const DEAN = 'dean';
    const VICE_RECTOR = 'vice-rector';
    const RECTOR = 'rector';
    const ADMIN = 'admin';

    const TEACHER_STATUS_MAP = [
        self::ASSISTANT,
        self::TEACHER,
        self::MASTER,
        self::DEAN,
        self::VICE_RECTOR,
        self::RECTOR,
    ];

    public static function tableName(): string
    {
        return 'status';
    }

    public function rules(): array
    {
        return [
            [['level'], 'integer'],
            [['name', 'label'], 'string', 'max' => 32],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Статус',
            'label' => 'Название',
            'level' => 'Уровень',
        ];
    }

    public function getUsers(): ActiveQuery
    {
        return $this->hasMany(User::class, ['status_id' => 'id']);
    }
}
