<?php

namespace Academy\classes\entities\users;

use mysqli;

class User
{
    const STATUS_STUDENT = 'student';
    const STATUS_ASSISTANT = 'assistant';
    const STATUS_TEACHER = 'teacher';
    const STATUS_MASTER = 'master';
    const STATUS_DEAN = 'dean';
    const STATUS_VICE_RECTOR = 'vice_rector';
    const STATUS_RECTOR = 'rector';
    const STATUS_ADMIN = 'admin';

    const ACTION_TAKE_LESSON = 'take lesson';
    const ACTION_TAKE_EXAMS = 'take exams';
    const ACTION_CHANGE_LECTURE = 'change lecture';
    const ACTION_CHANGE_SCHEDULE = 'change schedule';
    const ACTION_CHANGE_ASSISTANT = 'change assistant status';
    const ACTION_CHANGE_TEACHER = 'change teacher status';
    const ACTION_CHANGE_MASTER = 'change master status';
    const ACTION_CHANGE_VICE_RECTOR = 'change vice rector status';
    const ACTION_CHANGE_RECTOR = 'change rector status';
    const ACTION_DELETE_ACCOUNT = 'delete account';

    const STATUS_MAP = [
        self::STATUS_STUDENT => 'Студент',
        self::STATUS_ASSISTANT => 'Помощник-референт',
        self::STATUS_TEACHER => 'Преподаватель',
        self::STATUS_MASTER => 'Магистр',
        self::STATUS_DEAN => 'Декан',
        self::STATUS_VICE_RECTOR => 'Проректор',
        self::STATUS_RECTOR => 'Ректор',
        self::STATUS_ADMIN => 'Администратор'
    ];

    const ACTIONS_MAP = [
        self::ACTION_TAKE_LESSON => [
            self::STATUS_TEACHER,
            self::STATUS_MASTER,
            self::STATUS_DEAN,
            self::STATUS_VICE_RECTOR,
            self::STATUS_RECTOR,
            self::STATUS_ADMIN
        ],
        self::ACTION_TAKE_EXAMS => [
            self::STATUS_MASTER,
            self::STATUS_DEAN,
            self::STATUS_VICE_RECTOR,
            self::STATUS_RECTOR,
            self::STATUS_ADMIN
        ],
        self::ACTION_CHANGE_LECTURE => [
            self::STATUS_MASTER,
            self::STATUS_DEAN,
            self::STATUS_VICE_RECTOR,
            self::STATUS_RECTOR,
            self::STATUS_ADMIN
        ],
        self::ACTION_CHANGE_SCHEDULE => [
            self::STATUS_DEAN,
            self::STATUS_VICE_RECTOR,
            self::STATUS_RECTOR,
            self::STATUS_ADMIN
        ],
        self::ACTION_CHANGE_ASSISTANT => [
            self::STATUS_DEAN,
            self::STATUS_VICE_RECTOR,
            self::STATUS_RECTOR,
            self::STATUS_ADMIN
        ],
        self::ACTION_CHANGE_TEACHER => [
            self::STATUS_DEAN,
            self::STATUS_VICE_RECTOR,
            self::STATUS_RECTOR,
            self::STATUS_ADMIN
        ],
        self::ACTION_CHANGE_MASTER => [
            self::STATUS_VICE_RECTOR,
            self::STATUS_RECTOR,
            self::STATUS_ADMIN
        ],
        self::ACTION_CHANGE_VICE_RECTOR => [
            self::STATUS_RECTOR,
            self::STATUS_ADMIN
        ],
        self::ACTION_CHANGE_RECTOR => [
            self::STATUS_ADMIN
        ],
        self::ACTION_DELETE_ACCOUNT => [
            self::STATUS_RECTOR,
            self::STATUS_ADMIN
        ]
    ];

    protected mysqli $link;

    private int $id;
    private string $name;
    private int $fivemId;
    private string $discord;
    private string $status;
    private array $formation;
    private string $registrationDate;

    function __construct(
        mysqli $link,
        int $id,
        string $name,
        int $fivemId,
        string $discord,
        string $status,
        int $formationId,
        string $registrationDate
    ) {
        $this->link = $link;
        $this->id = $id;
        $this->name = $name;
        $this->fivemId = $fivemId;
        $this->discord = $discord;
        $this->status = $status;
        $this->registrationDate = $registrationDate;

        $this->formation = getFormationById($link, $formationId);

        if ($this->formation) {
            $this->formation = $this->formation[0];
        }
    }

    /**
     * Возвращает идентификатор пользователя в базе данных
     *
     * @return int Идентификатор
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Возвращает имя пользователя
     *
     * @return string Имя
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Возвращает идентификатор пользователя на платформе
     *
     * @return int Идентификатор пользователя на платформе
     */
    public function getFivemId(): int {
        return $this->fivemId;
    }

    /**
     * Возвращает Discord пользователя
     *
     * @return string Discord
     */
    public function getDiscord(): string {
        return $this->discord;
    }

    /**
     * Возвращает данные о названии и коде статуса пользователя
     *
     * @return array Данные о статусе
     */
    public function getStatus(): array {
        return [
            'name' => $this->status,
            'title' => self::STATUS_MAP[$this->status]
        ];
    }

    /**
     * Возвращает массив с данными о формации пользователя
     *
     * @return array Данные о формации
     */
    public function getFormation(): array {
        return $this->formation;
    }

    /**
     * Возвращает дату регистрации пользователя
     *
     * @return string Дата регистрации
     */
    public function getRegistrationDate(): string {
        return $this->registrationDate;
    }

    /**
     * Проверяет, может ли пользователь выполнить указанное действие
     *
     * @param string $action Действие
     *
     * @return bool
     */
    public function isActionAvailable(string $action): bool {
        return in_array($this->status, self::ACTIONS_MAP[$action]);
    }

    /**
     * Добавляет пользователя в список на одобрение в преподавательский состав
     *
     * @return array|false
     */
    public function addToTeachersCheckList(): array|false
    {
        $sql = "INSERT INTO teachers_check_list (user_id) VALUES (?)";

        return dbQuery($this->link, $sql, [$this->id]);
    }
}
