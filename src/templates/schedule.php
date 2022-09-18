<?php

use Academy\classes\entities\users\User;
use Academy\classes\entities\Schedule;

/**
 * @var User $user
 * @var array $schedule
 */

?>

<section class="schedule">
    <h1 class="main__title">Расписание Академии Ночи</h1>
    <?php foreach ($schedule as $day): ?>
        <div class="schedule-day">
            <div class="schedule-day__title"><?= $day['title'] . ' | ' . $day['date'] ?></div>
            <table class="schedule__table">
                <tr>
                    <th>Лекция</th>
                    <th>Время</th>
                    <th>Преподаватель</th>
                    <th>Длительность</th>
                </tr>
                <?php foreach ($day['lectures'] as $lecture): ?>
                    <tr>
                        <?php if ($lecture['type'] === Schedule::SCHEDULE_TYPE_LECTURE): ?>
                            <?php $teacher = $lecture['teacher']; ?>
                            <td><?= 'Лекция ' . $lecture['id'] . '. ' . htmlspecialchars($lecture['name']) ?></td>
                            <td><?= date('H:i:s', strtotime($lecture['time'])) ?></td>
                            <td>
                                <?= User::STATUS_MAP[$teacher['status']] . ' ' . htmlspecialchars($teacher['username']) ?>
                            </td>
                            <td><?= getNounPluralForm($lecture['duration'], 'час', 'часа', 'часов') ?></td>
                        <?php elseif ($lecture['type'] === Schedule::SCHEDULE_TYPE_ATTESTATION): ?>
                            <td>Аттестация</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        <?php elseif ($lecture['type'] === Schedule::SCHEDULE_TYPE_EXAMINATION): ?>
                            <td>Экзамен</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        <?php elseif ($lecture['type'] === Schedule::SCHEDULE_TYPE_VACATION): ?>
                            <td>Выходной</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        <?php elseif ($lecture['type'] === Schedule::SCHEDULE_TYPE_FREE): ?>
                            <td class="schedule__free"></td>
                            <td class="schedule__free"></td>
                            <td class="schedule__free"></td>
                            <td class="schedule__free"></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endforeach; ?>
</section>
