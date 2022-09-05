<?php

namespace Academy\classes\entities\users\highLevel;

use Academy\classes\entities\users\User;

require_once 'vendor/autoload.php';
require_once 'src/data/init.php';
require_once 'src/helpers/mainHelpers.php';

class UserHighLevel extends User
{
    /**
     * Убирает пользователя, которого приняли в преподавательский состав, из списка ожидания
     *
     * @param int $userId
     *
     * @return void
     */
    private function removeUserFromQuery(int $userId): void
    {
        $sql = "DELETE FROM teachers_check_list WHERE user_id = ?";

        dbQuery($this->link, $sql, [$userId]);
    }

    /**
     * Принимает пользователя, подавшего заявку на вступление в преподавательский состав
     *
     * @param int $userId
     *
     * @return array<int|string>|false
     */
    public function acceptNewTeacher(int $userId): array|false
    {
        $sql = "UPDATE users SET status = ? WHERE id = ?";

        $this->removeUserFromQuery($userId);

        return dbQuery($this->link, $sql, ['teacher', $userId]);
    }
}
