<?php

namespace app\models;

use Yii;
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
 * @property string|null $auth_key
 * @property string|null $access_token
 *
 * @property DayLecture[] $dayLectures
 * @property FormationUser[] $formationUsers
 * @property TeacherQueue[] $teacherQueues
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * Return all users from table
     *
     * @return ActiveRecord[]
     */
    private function getAllUsers(): array
    {
        return self::findAll([]);
    }

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
            [['auth_key', 'access_token'], 'string', 'max' => 32],
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
    public static function findIdentity($id): User|null
    {
        return self::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null): User|null
    {
        return self::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by FiveM ID
     *
     * @param int $fivemId
     *
     * @return User|null
     */
    public static function findIdentityByFivemId(int $fivemId): User|null
    {
        return self::findOne(['fivem_id' => $fivemId]);
    }

    /**
     * @inheritDoc
     */
    public function getId(): int|string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password
     *
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
        return $this->password === $password;
    }
}
