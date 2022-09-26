<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use app\models\Status;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int|null $status_id
 * @property string|null $username
 * @property int|null $fivem_id
 * @property string|null $discord
 * @property string|null $password
 * @property string|null $registration_date
 * @property string|null $auth_key
 * @property string|null $access_token
 *
 * @property DayLecture[] $dayLectures
 * @property FormationUser[] $formationUsers
 * @property Status $status
 * @property StudentVisit[] $studentVisits
 * @property TeacherActivity[] $teacherActivities
 * @property TeacherQueue[] $teacherQueues
 */
class User extends ActiveRecord implements IdentityInterface
{
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
    const ACTION_DELETE_ACCOUNT = 'delete account';
    const ACTION_SUBMIT_LECTURE = 'submit lecture';
    const ACTION_ZIP_LECTURE = 'zip lecture';
    const ACTION_VIEW_STUDENTS = 'view students';
    const ACTION_VIEW_ALL_USERS = 'view all users';

    const ACTIONS_LEVEL_MAP = [
        self::ACTION_TAKE_LESSON => 2,
        self::ACTION_TAKE_EXAMS => 4,
        self::ACTION_CREATE_LECTURE => 4,
        self::ACTION_CHANGE_LECTURE => 4,
        self::ACTION_DELETE_LECTURE => 4,
        self::ACTION_CHANGE_SCHEDULE => 4,
        self::ACTION_CHANGE_ASSISTANT => 5,
        self::ACTION_CHANGE_TEACHER => 6,
        self::ACTION_CHANGE_MASTER => 6,
        self::ACTION_CHANGE_VICE_RECTOR => 7,
        self::ACTION_CHANGE_RECTOR => 8,
        self::ACTION_DELETE_ACCOUNT => 6,
        self::ACTION_SUBMIT_LECTURE => 5,
        self::ACTION_ZIP_LECTURE => 5,
        self::ACTION_VIEW_STUDENTS => 4,
        self::ACTION_VIEW_ALL_USERS => 5,
    ];

    public static function tableName(): string
    {
        return 'user';
    }

    public function rules(): array
    {
        return [
            [['status_id', 'fivem_id'], 'integer'],
            [['registration_date'], 'safe'],
            [['username', 'discord'], 'string', 'max' => 128],
            [['password'], 'string', 'max' => 64],
            [['auth_key', 'access_token'], 'string', 'max' => 32],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'status_id' => 'Status ID',
            'username' => 'Имя',
            'fivem_id' => 'Fivem ID',
            'discord' => 'Discord',
            'password' => 'Пароль',
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

    public function getStatus(): ActiveQuery
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
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
        return $this->status->level >= self::ACTIONS_LEVEL_MAP[$action];
    }

    public function isLectureVisited(int $lectureId): StudentVisit|bool
    {
        $visitedLectures = $this->studentVisits;

        foreach ($visitedLectures as $visitedLecture) {
            if ($visitedLecture->id === $lectureId) {
                return $visitedLecture;
            }
        }

        return false;
    }
}
