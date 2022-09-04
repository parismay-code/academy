<?php
require_once "dbHelpers.php";

/**
 * Собирает список всех существующих в базе данных формаций
 *
 * @param mysqli $link Ресурс подключения
 *
 * @return array|false Массив формаций, либо false из-за ошибки запроса
 */
function getFormationsData(mysqli $link): array|false
{
    $sql = "SELECT * FROM formations";

    return dbQuery($link, $sql);
}

/**
 * Ищет информацию о формации по ее ID
 *
 * @param mysqli $link Ресурс подключения
 * @param int $formationId Идентификатор формации
 *
 * @return array|false Массив с информацией о формации, либо false из-за ошибки запроса
 */
function getFormationById(mysqli $link, int $formationId): array|false
{
    $sql = "SELECT * FROM formations WHERE id = ?";

    return dbQuery($link, $sql, [$formationId]);
}

/**
 * Собирает список всех пользователей, находящихся в одной формации
 *
 * @param mysqli $link Ресурс подключения
 * @param int $formationId Идентификатор формации
 *
 * @return array|false Массив пользователей, либо false из-за ошибки запроса
 */
function getUsersByFormationId(mysqli $link, int $formationId): array|false
{
    $sql = "SELECT * FROM users WHERE formation_id = ?";

    return dbQuery($link, $sql, [$formationId]);
}

/**
 * Ищет пользователя по его FiveM ID
 *
 * @param mysqli $link Ресурс подключения
 * @param int $fivemId Идентификатор пользователя
 *
 * @return array|false Массив с данными пользователя, либо false из-за ошибки запроса
 */
function getUserByFivemId(mysqli $link, int $fivemId): array|false
{
    $sql = "SELECT * FROM users WHERE fivem_id = ?";

    return dbQuery($link, $sql, [$fivemId]);
}

/**
 * Собирает список всех пользователей, претендующих на место учителя
 *
 * @param mysqli $link Ресурс подключения
 *
 * @return array|false Массив пользователей, либо false из-за ошибки запроса
 */
function getTeachersCheckList(mysqli $link): array|false
{
    $sql = "";

    return dbQuery($link, $sql);
}
