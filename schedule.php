<?php
require_once 'src/data/init.php';
require_once 'src/helpers/mainHelpers.php';
require_once 'requiresAuth.php';

use Academy\classes\entities\users\User;
use Academy\classes\entities\Schedule;

/**
 * @var mysqli $link Ресурс подключения
 * @var User $user Данные о пользователе
 */

$lectures = [];

$sql = "SELECT * FROM schedule";
$scheduleResult = dbQuery($link, $sql);

$schedule = new Schedule($link, $scheduleResult ?? []);

$sql = "SELECT * FROM lectures";
$lecturesResult = dbQuery($link, $sql);

if (!empty($result)) {
    $lectures = $lecturesResult;
}

$data = [
    $schedule->getDayData(0),
    $schedule->getDayData(1),
    $schedule->getDayData(2),
    $schedule->getDayData(3),
    $schedule->getDayData(4),
    $schedule->getDayData(5),
    $schedule->getDayData(6)
];

$content = includeTemplate('schedule.php', [
    'user' => $user,
    'schedule' => $data,
    'lectures' => $lectures
]);

$layout = includeTemplate('layout.php', [
    'user' => $user,
    'content' => $content,
    'title' => 'Vampires Academy | Schedule',
    'target' => 'schedule'
]);

print($layout);
