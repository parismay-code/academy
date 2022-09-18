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

    const SCHEDULE_TYPE_FREE = 'free';
    const SCHEDULE_TYPE_VACATION = 'vacation';
    const SCHEDULE_TYPE_LECTURE = 'lecture';
    const SCHEDULE_TYPE_ATTESTATION = 'attestation';
    const SCHEDULE_TYPE_EXAMINATION = 'examination';

    const TYPE_DURATION_MAP = [
        self::SCHEDULE_TYPE_FREE => 0,
        self::SCHEDULE_TYPE_VACATION => 0,
        self::SCHEDULE_TYPE_LECTURE => 1,
        self::SCHEDULE_TYPE_ATTESTATION => 1,
        self::SCHEDULE_TYPE_EXAMINATION => 4
    ];

    private mysqli $link;
    private array $lecturesData;

    function __construct(mysqli $link, array $lecturesData)
    {
        $this->link = $link;
        $this->lecturesData = $lecturesData;
    }

    public function getDayData(int $dayId): array
    {
        $title = self::DAYS_MAP[$dayId]['ru'];

        $timestamp = strtotime(self::DAYS_MAP[$dayId]['en']);

        if ($timestamp > strtotime(self::DAYS_MAP[6]['en'])) {
            $timestamp = strtotime('-1 week', $timestamp);
        }

        $date = date('d.m.Y', $timestamp);

        $lectures = [];

        foreach ($this->lecturesData as $lectureData) {
            if ($lectureData['day_id'] === $dayId) {
                $teacher = [];

                $teacherData = getUserById($this->link, $lectureData['teacher_id']);

                if (!empty($teacherData)) {
                    $teacher = $teacherData[0];
                }

                $lecture = [];

                $sql = "SELECT * FROM lectures WHERE id = ?";
                $result = dbQuery($this->link, $sql, [$lectureData['lecture_id']]);

                if (!empty($result)) {
                    $lecture = $result[0];
                }

                $lectures[] = [
                    'number' => $lectureData['lecture_number'] ?? count($lectures) + 1,
                    'type' => $lectureData['type'] ?? self::SCHEDULE_TYPE_FREE,
                    'id' => $lecture['id'] ?? null,
                    'name' => $lecture['title'] ?? null,
                    'time' => $lectureData['lecture_time'] ?? null,
                    'teacher' => $teacher ?? null,
                    'duration' => self::TYPE_DURATION_MAP[$lectureData['type']] ?? null
                ];
            }
        }

        usort($lectures, fn($a, $b) => ($a['number'] - $b['number']));

        return ['title' => $title, 'date' => $date, 'lectures' => $lectures];
    }

    public function changeScheduleLection(int $dayId, int $lectureNumber, array $newData): array|false
    {
        $sql = "UPDATE schedule SET lecture_id = ?, lecture_time = ?, type = ?, teacher_id = ?"
            . "WHERE day_id = ? AND lecture_number = ?";

        return dbQuery($this->link, $sql, [...$newData, $dayId, $lectureNumber]);
    }
}
