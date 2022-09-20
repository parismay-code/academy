<?php

namespace Academy\classes\entities\users;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    const STATUS_STUDENT = ['label' => 'Студент', 'level' => 0];
    const STATUS_ASSISTANT = ['label' => 'Ассистент', 'level' => 1];
    const STATUS_TEACHER = ['label' => 'Преподаватель', 'level' => 2];
    const STATUS_MASTER = ['label' => 'Магистр', 'level' => 3];
    const STATUS_DEAN = ['label' => 'Декан', 'level' => 4];
    const STATUS_VICE_RECTOR = ['label' => 'Проректор', 'level' => 5];
    const STATUS_RECTOR = ['label' => 'Ректор', 'level' => 6];
    const STATUS_ADMIN = ['label' => 'Администратор', 'level' => 7];

    const ACTION_TAKE_LESSON = ['minimalLevel' => self::STATUS_ASSISTANT['level']];
    const ACTION_TAKE_EXAMS = ['minimalLevel' => self::STATUS_MASTER['level']];
    const ACTION_CHANGE_LECTURE = ['minimalLevel' => self::STATUS_MASTER['level']];
    const ACTION_CHANGE_SCHEDULE = ['minimalLevel' => self::STATUS_MASTER['level']];
    const ACTION_CHANGE_ASSISTANT = ['minimalLevel' => self::STATUS_DEAN['level']];
    const ACTION_CHANGE_TEACHER = ['minimalLevel' => self::STATUS_DEAN['level']];
    const ACTION_CHANGE_MASTER = ['minimalLevel' => self::STATUS_VICE_RECTOR['level']];
    const ACTION_CHANGE_VICE_RECTOR = ['minimalLevel' => self::STATUS_RECTOR['level']];
    const ACTION_CHANGE_RECTOR = ['minimalLevel' => self::STATUS_ADMIN['level']];
    const ACTION_DELETE_ACCOUNT = ['minimalLevel' => self::STATUS_MASTER['level']];

    public function getStatusDetails(string $status): array
    {
        return match ($status) {
            'student' => self::STATUS_STUDENT,
            'assistant' => self::STATUS_ASSISTANT,
            'teacher' => self::STATUS_TEACHER,
            'master' => self::STATUS_MASTER,
            'dean' => self::STATUS_DEAN,
            'vice-rector' => self::STATUS_VICE_RECTOR,
            'rector' => self::STATUS_RECTOR,
            'admin' => self::STATUS_ADMIN,
        };
    }

    /**
     * Возвращает идентификатор пользователя в базе данных
     *
     * @return int Идентификатор
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Возвращает имя пользователя
     *
     * @return string Имя
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mysqli $link Ресурс подключения
     * @param string $name Имя персонажа пользователя
     *
     * @return array|false
     */
    public function setName(mysqli $link, string $name): array|false
    {
        $this->name = $name;

        $sql = "UPDATE user SET username = ? WHERE id = ?";

        return dbQuery($link, $sql, [$name, $this->id]);
    }

    /**
     * Возвращает идентификатор пользователя на платформе
     *
     * @return int Идентификатор пользователя на платформе
     */
    public function getFivemId(): int
    {
        return $this->fivemId;
    }

    /**
     * @param mysqli $link Ресурс подключения
     * @param int $fivemId Идентификатор пользователя на сервере
     *
     * @return array|false
     */
    public function setFivemId(mysqli $link, int $fivemId): array|false
    {
        $this->fivemId = $fivemId;

        $sql = "UPDATE user SET fivemId = ? WHERE id = ?";

        return dbQuery($link, $sql, [$fivemId, $this->id]);
    }

    /**
     * Возвращает Discord пользователя
     *
     * @return string Discord
     */
    public function getDiscord(): string
    {
        return $this->discord;
    }

    /**
     * @param mysqli $link Ресурс подключения
     * @param string $discord
     *
     * @return array|false
     */
    public function setDiscord(mysqli $link, string $discord): array|false
    {
        $this->discord = $discord;

        $sql = "UPDATE user SET discord = ? WHERE id = ?";

        return dbQuery($link, $sql, [$discord, $this->id]);
    }

    /**
     * Возвращает данные о названии и коде статуса пользователя
     *
     * @return array Данные о статусе
     */
    public function getStatus(): array
    {
        return [
            'name' => $this->status,
            'title' => self::STATUS_MAP[$this->status]
        ];
    }

    /**
     * @param mysqli $link Ресурс подключения
     * @param string $status Название статуса
     *
     * @return array|false
     */
    public function setStatus(mysqli $link, string $status): array|false
    {
        $this->status = $status;

        $sql = "UPDATE user SET status = ? WHERE id = ?";

        return dbQuery($link, $sql, [$status, $this->id]);
    }

    /**
     * Возвращает массив с данными о формации пользователя
     *
     * @return array Данные о формации
     */
    public function getFormation(): array
    {
        return $this->formation;
    }

    /**
     * @param mysqli $link Ресурс подключения
     * @param int $formationId Идентификатор формации
     *
     * @return array|false
     */
    public function setFormation(mysqli $link, int $formationId): array|false
    {
        $this->formation = getFormationById($link, $formationId);

        if ($this->formation) {
            $this->formation = $this->formation[0];
        }

        $sql = "UPDATE user SET formationId = ? WHERE id = ?";

        return dbQuery($link, $sql, [$formationId, $this->id]);
    }

    /**
     * Возвращает дату регистрации пользователя
     *
     * @return string Дата регистрации
     */
    public function getRegistrationDate(): string
    {
        return $this->registrationDate;
    }

    /**
     * Проверяет, может ли пользователь выполнить указанное действие
     *
     * @param string $action Действие
     *
     * @return bool
     */
    public function isActionAvailable(string $action): bool
    {
        return in_array($this->status, self::ACTIONS_MAP[$action]);
    }

    /**
     * Проверяет, может ли пользователь изменить статус другого пользователя
     *
     * @param string $otherUserStatus Статус другого пользователя
     *
     * @return bool
     */
    public function canChangeOtherStatus(string $otherUserStatus): bool
    {
        return in_array($otherUserStatus, self::CHANGE_STATUS_MAP[$this->status]);
    }

    /**
     * Добавляет пользователя в список на одобрение в преподавательский состав
     *
     * @return array|false
     */
    public function addToTeachersCheckList(): array|false
    {
        $sql = "INSERT INTO teachersCheckList (userId) VALUES (?)";

        return dbQuery($this->link, $sql, [$this->id]);
    }
}
