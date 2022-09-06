<?php

/**
 * Устанавливает клиенту информацию о его почте и зашифрованном пароле в куки для дальнейшего упрощенного входа
 *
 * @param int $fivemId
 * @param string $password
 * @param int $expires
 *
 * @return void
 */
function setUserDataCookies(int $fivemId, string $password, int $expires): void
{
    setcookie('user_fivem_id', $fivemId, $expires);
    setcookie('user_password', $password, $expires);
}

/**
 * Привязывает к подготовленному выражению данные для корректного заполнения запроса
 *
 * @param mysqli_stmt $statement Подготовленное выражение
 * @param array $data Данные для заполнения запроса
 *
 * @return bool Были ли привязаны данные для заполнения запроса
 */
function bindStatementParams(mysqli_stmt $statement, array $data = []): bool
{
    $types = '';
    $statement_data = [];

    foreach ($data as $value) {
        $type = 's';

        if (is_int($value)) {
            $type = 'i';
        } else if (is_double($value)) {
            $type = 'd';
        }

        $types .= $type;
        $statement_data[] = $value;
    }

    $values = array_merge([$statement, $types], $statement_data);

    return mysqli_stmt_bind_param(...$values);
}

/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param mysqli $link Ресурс соединения
 * @param string $sql SQL запрос
 * @param array $data Данные для заполнения запроса
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function getPrepareStatement(mysqli $link, string $sql, array $data = []): mysqli_stmt
{
    $statement = mysqli_prepare($link, $sql);

    if (!$statement) {
        $errorMessage = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
        die($errorMessage);
    }

    if ($data) {
        bindStatementParams($statement, $data);
    }

    return $statement;
}

/**
 * Формирует подготовленное выражение из запроса и предоставленных данных, отправляет его и, если, запрос успешно
 * обработан, то возвращает массив с данными, либо false. Массив с данными возвращается для запросов, ответ на которые
 * их предполагает (по типу SELECT). False возвращается в случае INSERT и подобных запросов.
 * Также, для проваленных запросов, возвращается false.
 *
 * @param mysqli $link Ресурс соединения
 * @param string $sql SQL запрос
 * @param array $data Данные для заполнения запроса
 *
 * @return array|false В случае успеха возвращает массив или false. В случае провала всегда возвращает false.
 */
function dbQuery(mysqli $link, string $sql, array $data = []): array|false
{
    $statement = getPrepareStatement($link, $sql, $data);

    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    mysqli_stmt_close($statement);

    if (!$result) {
        return $result;
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

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
 * Ищет информацию о формации по ее названию
 *
 * @param mysqli $link Ресурс подключения
 * @param string $formationName Название формации
 *
 * @return array|false Массив с информацией о формации, либо false из-за ошибки запроса
 */
function getFormationByName(mysqli $link, string $formationName): array|false
{
    $sql = "SELECT * FROM formations WHERE name = ?";

    return dbQuery($link, $sql, [$formationName]);
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
