<?php

use Academy\classes\entities\users\User;

/**
 * @var User $user
 */

if (!$user) {
    header("Location: /");
    exit();
}
