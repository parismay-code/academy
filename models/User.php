<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $username
 * @property int|null $fivem_id
 * @property string|null $discord
 * @property string|null $password
 * @property string|null $status
 * @property string|null $registration_date
 *
 * @property DayLecture[] $dayLectures
 * @property FormationUser[] $formationUsers
 * @property TeacherQueue[] $teacherQueues
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['fivem_id'], 'integer'],
            [['registration_date'], 'safe'],
            [['username', 'discord'], 'string', 'max' => 128],
            [['password', 'status'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'username' => 'Имя',
            'discord' => 'Discord',
            'password' => 'Пароль',
            'status' => 'Статус',
            'registration_date' => 'Дата регистрации',
        ];
    }

    /**
     * Gets query for [[DayLectures]].
     *
     * @return ActiveQuery
     */
    public function getDayLectures(): ActiveQuery
    {
        return $this->hasMany(DayLecture::class, ['teacher_id' => 'id']);
    }

    /**
     * Gets query for [[FormationUsers]].
     *
     * @return ActiveQuery
     */
    public function getFormationUsers(): ActiveQuery
    {
        return $this->hasMany(FormationUser::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TeacherQueues]].
     *
     * @return ActiveQuery
     */
    public function getTeacherQueues(): ActiveQuery
    {
        return $this->hasMany(TeacherQueue::class, ['user_id' => 'id']);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        $users = User::findAll();
        return isset($users[$id - 1]);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        // TODO: Implement getId() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
