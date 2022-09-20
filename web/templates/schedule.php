<?php

use Academy\classes\entities\Schedule;
use Academy\classes\entities\users\User;

/**
 * @var User $user
 * @var Schedule $schedule
 */

?>

<section class="schedule">
    <h1 class="main__title">Расписание Академии Ночи</h1>
    <div class="schedule__wrapper">
        <?php $i = 0; ?>
        <?php foreach ($schedule->getScheduleData() as $el): ?>
            <div class="schedule-day <?= $el['date'] === date('d.m.Y') ? 'schedule-day_active' : '' ?>">
                <div class="schedule-day__title">
                    <?= $el['dayName'] . ' | ' . $el['date'] ?>
                    <?php if ($user->isActionAvailable(User::ACTION_CHANGE_SCHEDULE)): ?> |
                        <span class="schedule-day__title schedule-day__title_link" onclick="toggleTable(<?= $i ?>)">Изменить</span>
                    <?php endif; ?>
                </div>
                <div class="schedule__table table" id="schedule<?= $i?>">
                    <?php if ($el['type'] === Schedule::SCHEDULE_TYPE_VACATION): ?>
                        <div class="schedule__vacation"><?= Schedule::SCHEDULE_MAP[$el['type']] ?></div>
                    <?php endif; ?>
                    <?php if ($el['type'] === Schedule::SCHEDULE_TYPE_LECTURES): ?>
                        <div class="table__header">
                            <div class="table__data schedule__title">Лекция</div>
                            <div class="table__data schedule__time">Время</div>
                            <div class="table__data schedule__teacher">Преподаватель</div>
                            <div class="table__data schedule__duration">Длительность</div>
                        </div>
                        <?php foreach ($el['lectures'] as $lecture): ?>
                            <?php
                            $isActive = false;
                            $diff = strtotime($lecture['time']) - time();

                            if ($diff < 0) {
                                $diff *= -1;
                            }

                            if ($el['date'] === date('d.m.Y') && $diff <= 7200) {
                                $isActive = true;
                            }
                            ?>
                            <div class="table__row <?= $isActive ? 'table__row_active' : '' ?>">
                                <div class="table__data schedule__title">
                                    <?= htmlspecialchars($lecture['title']) ?>
                                </div>
                                <div class="table__data schedule__time">
                                    <?= is_numeric($lecture['time']) ? date('H:i',
                                        strtotime($lecture['time'])) : $lecture['time'] ?>
                                </div>
                                <div class="table__data schedule__teacher">
                                    <?= htmlspecialchars($lecture['teacher']) ?>
                                </div>
                                <div class="table__data schedule__duration">
                                    <?= getNounPluralForm($lecture['duration'], 'час', 'часа', 'часов') ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ($el['type'] === Schedule::SCHEDULE_TYPE_ATTESTATION || $el['type'] === Schedule::SCHEDULE_TYPE_EXAMINATION): ?>
                        <div class="table__row table__examination">
                            <div class="table__data schedule__title">
                                <?= Schedule::SCHEDULE_MAP[$el['type']] ?>
                            </div>
                            <div class="table__data schedule__time">
                                <?= 'С ' . $el['from'] . ' до ' . $el['to'] ?>
                            </div>
                            <div class="table__data schedule__duration">
                                <?php
                                $from = strtotime($el['from']);
                                $to = strtotime($el['to']);
                                $diff = ($to - $from) / 60 / 60;

                                echo getNounPluralForm($diff, 'час', 'часа', 'часов')
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <form class="schedule__change schedule__hidden" id="change<?= $i?>" name="changeScheduleForm" action="schedule.php"
                      method="post">
                    1234
                </form>
            </div>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>
</section>
<script>
    const toggleTable = (id) => {
        let table = document.getElementById('schedule' + id);
        let changeDiv = document.getElementById('change' + id);

        table.classList.toggle('schedule__hidden');
        changeDiv.classList.toggle('schedule__hidden');
    }
</script>
