<?php

use yii\helpers\Html;
use app\models\ScheduleDay;
use app\models\User;

/**
 * @var yii\web\View $this
 * @var ScheduleDay[] $schedules
 */

$user = User::findOne(Yii::$app->user->id);

$this->title = 'Vampires Academy | Расписание';
?>

<section>
    <h4 class="mb-3">Расписание Академии Ночи</h4>
    <div class="d-flex flex-row align-items-start justify-content-between flex-wrap">
        <?php foreach ($schedules as $schedule): ?>
            <?php
            $dayData = ScheduleDay::DAYS_MAP[$schedule->id];

            $title = $dayData['ru'];
            $timestamp = strtotime($dayData['en']);

            if ($timestamp > strtotime('Sunday')) {
                $timestamp = strtotime('-1 week', $timestamp);
            }

            $date = date('d.m.Y', $timestamp);

            $isScheduleToday = $date === date("d.m.Y", time());

            $isVacation = $schedule->type === ScheduleDay::TYPE_VACATION;
            $isLecture = $schedule->type === ScheduleDay::TYPE_LECTURE;
            $isAttestationOrExamination = $schedule->type === ScheduleDay::TYPE_ATTESTATION || $schedule->type === ScheduleDay::TYPE_EXAMINATION
            ?>
            <?php if ($isVacation && $user->isActionAvailable(User::ACTION_CHANGE_SCHEDULE)): ?>
                <div class="col-xxl-6 mb-4 px-3">
                    <h5 class="mb-4">
                        <?= "$title | $date" ?>
                        <?php if ($user->isActionAvailable(User::ACTION_CHANGE_SCHEDULE)): ?> |
                            <?= Html::a('Изменить', ['schedule/change', 'id' => $schedule->id],
                                ['class' => 'link-secondary text-decoration-none']) ?>
                        <?php endif; ?>
                    </h5>
                    <div
                            style="height: 15.5rem; border: 1px solid #373b3e; background-color: #212529; pointer-events: none; user-select: none;"
                            class="d-flex align-items-center justify-content-center text-uppercase fw-bold fs-5"
                            id=<?= 'schedule' . $schedule->id ?>
                    >
                        Выходной
                    </div>
                </div>
            <?php elseif (!$isVacation): ?>
                <div class="col-xxl-6 mb-4 px-3">
                    <h5 class="mb-4">
                        <?= "$title | $date" ?>
                        <?php if ($user->isActionAvailable(User::ACTION_CHANGE_SCHEDULE)): ?> |
                            <?=
                            Html::a
                            (
                                'Изменить',
                                ['schedule/change', 'id' => $schedule->id],
                                ['class' => 'link-secondary text-decoration-none']
                            );
                            ?>
                        <?php endif; ?>
                    </h5>
                    <table
                            style="user-select: none"
                            class="table table-bordered table-striped table-hover table-dark"
                            id=<?= 'schedule' . $schedule->id ?>
                    >
                        <?php if ($isLecture): ?>
                            <thead>
                            <tr>
                                <th class="col-3">Лекция</th>
                                <th class="col-3 text-center">Преподаватель</th>
                                <th class="col-1 text-center">Время</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($schedule->dayLectures as $dayLecture): ?>
                                <?php
                                $isFree = $dayLecture->is_free;
                                $lectureTime = $dayLecture->time . ':00';
                                $lecture = $dayLecture->lecture;
                                $teacher = $dayLecture->teacher;

                                $lectureTimestamp = strtotime($lectureTime);

                                $diff = time() - $lectureTimestamp;

                                if ($diff < 0) {
                                    $diff *= -1;
                                    $diff /= 60;
                                    $diff *= -1;
                                } else {
                                    $diff /= 60;
                                }
                                ?>
                                <?php if ($isFree): ?>
                                    <tr>
                                        <td class="col-3">
                                            <?php if ($user->isActionAvailable(User::ACTION_TAKE_LESSON)): ?>
                                                <?=
                                                Html::a
                                                (
                                                    'Свободно',
                                                    [
                                                        'schedule/appoint',
                                                        'id' => $dayLecture->id
                                                    ],
                                                    ['class' => 'link-secondary text-decoration-none border-bottom']
                                                )
                                                ?>
                                            <?php else: ?>
                                                Свободно
                                            <?php endif; ?>
                                        </td>
                                        <td class="col-3 text-center">-</td>
                                        <td class="col-1 text-center"><?= $lectureTime ?></td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td class="col-3">
                                            <?php if ($user->isActionAvailable(User::ACTION_CHANGE_SCHEDULE)): ?>
                                                <?=
                                                Html::a
                                                (
                                                    Html::encode("$lecture->id. $lecture->title"),
                                                    [
                                                        'schedule/appoint',
                                                        'id' => $dayLecture->id
                                                    ],
                                                    ['class' => 'link-secondary text-decoration-none border-bottom']
                                                )
                                                ?>
                                            <?php else: ?>
                                                <?= Html::encode($lecture->title) ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="col-3 text-center">
                                            <?= Html::encode($teacher->username) ?>
                                        </td>
                                        <td class="col-1 text-center">
                                            <?php if ($diff > 60 || $diff < -10 || !$isScheduleToday): ?>
                                                <?= $lectureTime ?>
                                            <?php else: ?>
                                                <?=
                                                Html::a
                                                (
                                                    $lectureTime,
                                                    ['schedule/presence', 'id' => $dayLecture->id],
                                                    ['class' => 'link-secondary text-decoration-none border-bottom']
                                                );
                                                ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        <?php endif; ?>
                        <?php if ($isAttestationOrExamination): ?>
                            <thead>
                            <tr>
                                <th class="col-1 text-center">Тип</th>
                                <th class="col-1 text-center">Время</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="col-1 text-center">
                                    <?= $schedule->type === ScheduleDay::TYPE_ATTESTATION ? 'Аттестация' : 'Экзамен' ?>
                                </td>
                                <td class="col-1 text-center">
                                    <?= "С $schedule->from:00 до $schedule->to:00" ?>
                                </td>
                            </tr>
                            </tbody>
                        <?php endif; ?>
                    </table>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
