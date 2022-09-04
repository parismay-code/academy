<?php

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
