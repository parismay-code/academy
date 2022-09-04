<?php

namespace Academy\classes\entities\users;

use mysqli;

class User
{
    protected mysqli $link;
    protected array $data;
    protected array $formation;

    function __construct(mysqli $link, int $fivemId)
    {
        $data = getUserByFivemId($link, $fivemId);

        if (!$data) {
            echo "Ошибка запроса данных о пользователе";
            die();
        }

        $this->link = $link;
        $this->data = $data[0];
        $this->formation = getFormationById($link, $data[0]['formation_id']);
    }

    public function addUserToTeachersCheckList(): array|false
    {
        $sql = "INSERT INTO teachers_check_list (user_id) VALUES (?)";

        return dbQuery($this->link, $sql, [$this->data['id']]);
    }
}
