<?php
require_once 'src/data/init.php';
require_once 'src/helpers/mainHelpers.php';
require_once 'requiresAuth.php';

use Academy\classes\entities\users\User;
use Academy\classes\entities\users\mediumLevel\UserAssistant;
use Academy\classes\entities\users\mediumLevel\UserTeacher;
use Academy\classes\entities\users\highLevel\UserMaster;
use Academy\classes\entities\users\highLevel\UserDean;
use Academy\classes\entities\users\highLevel\UserViceRector;
use Academy\classes\entities\users\highLevel\UserRector;

/**
 * @var mysqli $link Ресурс подключения
 * @var User $user Данные о пользователе
 */

$activeControls = $_GET['controls'] ?? 0;

$teachersList = [];

/**
 * Проверяет, подал ли пользователь заявку в преподавательский состав
 *
 * @param mysqli $link Ресурс подключения
 * @param int $userId Идентификатор пользователя
 *
 * @return bool
 */
function isUserInTeacherCheckList(mysqli $link, int $userId): bool
{
    $sql = "SELECT * FROM teachers_check_list WHERE user_id = ?";

    $result = dbQuery($link, $sql, [$userId]);

    return !empty($result);
}

/**
 * Сортирует список преподавательского состава и возвращает его в иерархическом порядке, создав экземпляры класса User
 *
 * @param mysqli $link Ресурс подключения
 * @param array $teachersList Список преподавателей
 *
 * @return array Измененный список преподавателей
 */
function sortTeachersList(mysqli $link, array $teachersList): array
{
    $rector = [];
    $viceRector = [];
    $deans = [];
    $masters = [];
    $teachers = [];
    $assistants = [];

    foreach ($teachersList as $user) {
        $userData = [
            $link,
            $user['id'],
            $user['username'],
            $user['fivem_id'],
            $user['discord'],
            $user['status'],
            $user['formation_id'],
            $user['registration_date']
        ];

        switch ($user['status']) {
            case User::STATUS_ASSISTANT:
                $assistants[] = new UserAssistant(...$userData);
                break;
            case User::STATUS_TEACHER:
                $teachers[] = new UserTeacher(...$userData);
                break;
            case User::STATUS_MASTER:
                $masters[] = new UserMaster(...$userData);
                break;
            case User::STATUS_DEAN:
                $deans[] = new UserDean(...$userData);
                break;
            case User::STATUS_VICE_RECTOR:
                $viceRector[] = new UserViceRector(...$userData);
                break;
            case User::STATUS_RECTOR:
                $rector[] = new UserRector(...$userData);
                break;
        }
    }

    return [...$rector, ...$viceRector, ...$deans, ...$masters, ...$teachers, ...$assistants];
}

$sql = "SELECT * FROM users WHERE status != ?";

$result = dbQuery($link, $sql, [User::STATUS_STUDENT]);

if (!empty($result)) {
    $teachersList = sortTeachersList($link, $result);
}

$isInTeacherCheckList = isUserInTeacherCheckList($link, $user->getId());

$content = includeTemplate('teachers.php', [
    'user' => $user,
    'teachersList' => $teachersList,
    'isInTeacherCheckList' => $isInTeacherCheckList,
    'activeControls' => (int)$activeControls
]);

$layout = includeTemplate('layout.php', [
    'user' => $user,
    'content' => $content,
    'title' => 'Vampires Academy | Teachers',
    'target' => 'teachers'
]);

print($layout);
