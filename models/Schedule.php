<?php

namespace Academy\classes\entities;

use mysqli;

class Schedule
{
    const DAYS_MAP = [
        ['en' => 'Monday', 'ru' => 'Понедельник'],
        ['en' => 'Tuesday', 'ru' => 'Вторник'],
        ['en' => 'Wednesday', 'ru' => 'Среда'],
        ['en' => 'Thursday', 'ru' => 'Четверг'],
        ['en' => 'Friday', 'ru' => 'Пятница'],
        ['en' => 'Saturday', 'ru' => 'Суббота'],
        ['en' => 'Sunday', 'ru' => 'Воскресенье']
    ];

    const SCHEDULE_TYPE_VACATION = 'vacation';
    const SCHEDULE_TYPE_LECTURES = 'lectures';
    const SCHEDULE_TYPE_ATTESTATION = 'attestation';
    const SCHEDULE_TYPE_EXAMINATION = 'examination';

    const SCHEDULE_MAP = [
        self::SCHEDULE_TYPE_VACATION => 'Выходной',
        self::SCHEDULE_TYPE_LECTURES => 'Лекции',
        self::SCHEDULE_TYPE_ATTESTATION => 'Аттестация',
        self::SCHEDULE_TYPE_EXAMINATION => 'Экзамен'
    ];

    private mysqli $link;
    private array $schedule;

    function __construct(mysqli $link, array $schedule)
    {
        $this->link = $link;
        $this->schedule = $schedule;
    }

    /**
     * Возврвщает информацию о лекциях, проводимых в указанный день
     *
     * @param int $dayId Номер дня
     *
     * @return array|false
     */
    private function getLecturesByDayId(int $dayId): array|false
    {
        $sql = "SELECT * FROM scheduleDayLecture WHERE dayId = ?";

        return dbQuery($this->link, $sql, [$dayId]);
    }

    /**
     * Возвращает информацию об учебных днях, лекциях и преподавателям
     *
     * @return array
     */
    public function getScheduleData(): array
    {
        $result = [];

        $dayId = 0;

        foreach ($this->schedule as $day) {
            $timestamp = strtotime(self::DAYS_MAP[$dayId]['en']);

            if ($timestamp > strtotime(self::DAYS_MAP[6]['en'])) {
                $timestamp = strtotime('-1 week', $timestamp);
            }

            $date = date('d.m.Y', $timestamp);
            $dayName = self::DAYS_MAP[$dayId]['ru'];

            $data = ['dayName' => $dayName, 'date' => $date, 'type' => $day['type'], 'from' => $day['from'], 'to' => $day['to'], 'lectures' => []];

            $lectures = $this->getLecturesByDayId(++$dayId) ?? [];

            foreach ($lectures as $el) {
                $lecture = getLectureById($this->link, $el['lecture_id']);
                $teacher = getUserById($this->link, $el['teacher_id']);

                if (empty($lecture) || empty($teacher)) {
                    continue;
                }

                $title = 'Лекция ' . $lecture[0]['id'] . '. ' . $lecture[0]['title'];

                if ($day['type'] !== self::SCHEDULE_TYPE_LECTURES) {
                    $title = self::SCHEDULE_MAP[$day['type']];
                }

                $data['lectures'][] = [
                    'title' => $title,
                    'teacher' => $teacher[0]['username'],
                    'time' => $el['time'],
                    'duration' => $el['duration']
                ];
            }

            usort($data['lectures'], fn($a, $b) => strtotime($a['time']) - strtotime($b['time']));

            while (count($data['lectures']) < 6) {
                $data['lectures'][] = [
                    'title' => 'Свободно',
                    'teacher' => '-',
                    'time' => '-',
                    'duration' => '-'
                ];
            }

            $result[] = $data;
        }

        return $result;
    }

    /**
     * Изменяет одну из лекций выбранного дня
     *
     * @param int $dayId Номер дня
     * @param int $lectureNumber Номер лекции
     * @param array $newData Новая информация о лекции
     *
     * @return array|false
     */
    public function changeScheduleLecture(int $dayId, int $lectureNumber, array $newData): array|false
    {
        $sql = "UPDATE schedule SET lecture_id = ?, lecture_time = ?, type = ?, teacher_id = ?"
            . "WHERE day_id = ? AND lecture_number = ?";

        return dbQuery($this->link, $sql, [...$newData, $dayId, $lectureNumber]);
    }
}
