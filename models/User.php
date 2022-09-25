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
 * @property StudentVisit[] $studentVisits
 * @property TeacherActivity[] $teacherActivities
 * @property TeacherQueue[] $teacherQueues
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_VISITOR = 'visitor';
    const STATUS_STUDENT = 'student';
    const STATUS_ASSISTANT = 'assistant';
    const STATUS_TEACHER = 'teacher';
    const STATUS_MASTER = 'master';
    const STATUS_DEAN = 'dean';
    const STATUS_VICE_RECTOR = 'vice-rector';
    const STATUS_RECTOR = 'rector';
    const STATUS_ADMIN = 'admin';

    const ACTION_TAKE_LESSON = 'take lesson';
    const ACTION_TAKE_EXAMS = 'take exams';
    const ACTION_CREATE_LECTURE = 'create lecture';
    const ACTION_CHANGE_LECTURE = 'change lecture';
    const ACTION_DELETE_LECTURE = 'delete lecture';
    const ACTION_CHANGE_SCHEDULE = 'change schedule';
    const ACTION_CHANGE_ASSISTANT = 'change assistant status';
    const ACTION_CHANGE_TEACHER = 'change teacher status';
    const ACTION_CHANGE_MASTER = 'change master status';
    const ACTION_CHANGE_VICE_RECTOR = 'change vice rector status';
    const ACTION_CHANGE_RECTOR = 'change rector status';
    const ACTION_SELF_DELETE_ACCOUNT = 'self delete account';
    const ACTION_DELETE_ACCOUNT = 'delete account';
    const ACTION_SUBMIT_LECTURE = 'submit lecture';
    const ACTION_ZIP_LECTURE = 'zip lecture';
    const ACTION_VIEW_STUDENTS = 'view students';
    const ACTION_VIEW_ALL_USERS = 'view all users';

    const STATUS_MAP = [
        self::STATUS_VISITOR => ['name' => 'Посетитель', 'level' => 0],
        self::STATUS_STUDENT => ['name' => 'Студент', 'level' => 1],
        self::STATUS_ASSISTANT => ['name' => 'Ассистент', 'level' => 2],
        self::STATUS_TEACHER => ['name' => 'Преподаватель', 'level' => 3],
        self::STATUS_MASTER => ['name' => 'Магистр', 'level' => 4],
        self::STATUS_DEAN => ['name' => 'Декан', 'level' => 5],
        self::STATUS_VICE_RECTOR => ['name' => 'Проректор', 'level' => 6],
        self::STATUS_RECTOR => ['name' => 'Ректор', 'level' => 7],
        self::STATUS_ADMIN => ['name' => 'Администратор', 'level' => 8],
    ];

    const ACTIONS_LEVEL_MAP = [
        self::ACTION_TAKE_LESSON => self::STATUS_MAP[self::STATUS_ASSISTANT]['level'],
        self::ACTION_TAKE_EXAMS => self::STATUS_MAP[self::STATUS_MASTER]['level'],
        self::ACTION_CREATE_LECTURE => self::STATUS_MAP[self::STATUS_MASTER]['level'],
        self::ACTION_CHANGE_LECTURE => self::STATUS_MAP[self::STATUS_MASTER]['level'],
        self::ACTION_DELETE_LECTURE => self::STATUS_MAP[self::STATUS_MASTER]['level'],
        self::ACTION_CHANGE_SCHEDULE => self::STATUS_MAP[self::STATUS_MASTER]['level'],
        self::ACTION_CHANGE_ASSISTANT => self::STATUS_MAP[self::STATUS_DEAN]['level'],
        self::ACTION_CHANGE_TEACHER => self::STATUS_MAP[self::STATUS_DEAN]['level'],
        self::ACTION_CHANGE_MASTER => self::STATUS_MAP[self::STATUS_VICE_RECTOR]['level'],
        self::ACTION_CHANGE_VICE_RECTOR => self::STATUS_MAP[self::STATUS_RECTOR]['level'],
        self::ACTION_CHANGE_RECTOR => self::STATUS_MAP[self::STATUS_ADMIN]['level'],
        self::ACTION_SELF_DELETE_ACCOUNT => self::STATUS_MAP[self::STATUS_VISITOR]['level'],
        self::ACTION_DELETE_ACCOUNT => self::STATUS_MAP[self::STATUS_RECTOR]['level'],
        self::ACTION_SUBMIT_LECTURE => self::STATUS_MAP[self::STATUS_DEAN]['level'],
        self::ACTION_ZIP_LECTURE => self::STATUS_MAP[self::STATUS_DEAN]['level'],
        self::ACTION_VIEW_STUDENTS => self::STATUS_MAP[self::STATUS_MASTER]['level'],
        self::ACTION_VIEW_ALL_USERS => self::STATUS_MAP[self::STATUS_DEAN]['level'],
    ];

    public static function tableName(): string
    {
        return 'user';
    }

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

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'username' => 'Имя',
            'fivem_id' => 'Fivem ID',
            'discord' => 'Discord',
            'password' => 'Пароль',
            'status' => 'Статус',
            'registration_date' => 'Дата регистрации',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

    public function getDayLectures(): ActiveQuery
    {
        return $this->hasMany(DayLecture::class, ['teacher_id' => 'id']);
    }

    public function getFormationUsers(): ActiveQuery
    {
        return $this->hasMany(FormationUser::class, ['user_id' => 'id']);
    }

    public function getStudentVisits(): ActiveQuery
    {
        return $this->hasMany(StudentVisit::class, ['student_id' => 'id']);
    }

    public function getTeacherActivities(): ActiveQuery
    {
        return $this->hasMany(TeacherActivity::class, ['teacher_id' => 'id']);
    }

    public function getTeacherQueues(): ActiveQuery
    {
        return $this->hasMany(TeacherQueue::class, ['user_id' => 'id']);
    }

    public static function findIdentity($id): static|null
    {
        return new static(self::findOne($id));
    }

    public static function findIdentityByAccessToken($token, $type = null): static|null
    {
        return new static(self::findOne(['access_token' => $token]));
    }

    public static function findIdentityByFivemId(int $fivemId): static|null
    {
        return new static(self::findOne(['fivem_id' => $fivemId]));
    }

    public function getId(): int|string
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword(string $password): bool
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function isActionAvailable(string $action): bool
    {
        return self::STATUS_MAP[$this->status]['level'] >= self::ACTIONS_LEVEL_MAP[$action];
    }

    public function isChangeUserStatusAvailable(string $userStatus): bool
    {
        return self::STATUS_MAP[$this->status]['level'] > self::STATUS_MAP[$userStatus]['level'];
    }

    public function getAvailableToChangeStatusList(): array
    {
        $result = [];

        foreach (self::STATUS_MAP as $key => $status) {
            if ($status['level'] < self::STATUS_MAP[$this->status]['level']) {
                $result[] = array('label' => $key, 'name' => $status['name'], 'level' => $status['level']);
            }
        }

        return $result;
    }
}
