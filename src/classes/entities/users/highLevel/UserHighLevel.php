<?php

namespace Academy\classes\entities\users\highLevel;

use Academy\classes\entities\users\User;

require_once 'vendor/autoload.php';
require_once 'src/data/init.php';
require_once 'src/helpers/mainHelpers.php';

class UserHighLevel extends User
{
    private function removeUserFromQuery($userId): void
    {
        $sql = "DELETE FROM teachers_check_list WHERE user_id = ?";

        dbQuery($this->link, $sql, [$userId]);
    }

    public function acceptNewTeacher($userId): array|false
    {
        $sql = "UPDATE users SET status = ? WHERE id = ?";

        $this->removeUserFromQuery($userId);

        return dbQuery($this->link, $sql, ['teacher', $userId]);
    }
}
