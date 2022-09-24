<?php

use yii\helpers\Html;
use app\models\ScheduleDay;
use app\models\User;

require_once Yii::$app->basePath . '/helpers/mainHelper.php';

/**
 * @var yii\web\View $this
 * @var ScheduleDay[] $models
 */

$user = User::findOne(Yii::$app->user->id);

$this->title = 'Vampires Academy | Расписание';
?>

<section>
    <h4 class="mb-5">Расписание Академии Ночи</h4>
    <div class="d-flex flex-row align-items-start justify-content-between flex-wrap">
        <?php foreach ($models as $model): ?>
            <?php
            $dayData = ScheduleDay::DAYS_MAP[$model->id];

            $title = $dayData['ru'];
            $timestamp = strtotime($dayData['en']);

            if ($timestamp > strtotime('Sunday')) {
                $timestamp = strtotime('-1 week', $timestamp);
            }

            $date = date('d.m.Y', $timestamp);

            $isVacation = $model->type === ScheduleDay::TYPE_VACATION;
            $isLecture = $model->type === ScheduleDay::TYPE_LECTURE;
            $isAttestationOrExamination = $model->type === ScheduleDay::TYPE_ATTESTATION || $model->type === ScheduleDay::TYPE_EXAMINATION
            ?>
            <?php if ($isVacation && $user->isActionAvailable(User::ACTION_CHANGE_SCHEDULE)): ?>
                <div class="col-xxl-6 mb-4 px-3">
                    <h5 class="mb-4">
                        <?= "$title | $date" ?>
                        <?php if ($user->isActionAvailable(User::ACTION_CHANGE_SCHEDULE)): ?> |
                            <?= Html::a('Изменить', ['schedule/change', 'type' => 'day', 'id' => $model->id],
                                ['class' => 'link-secondary text-decoration-none']) ?>
                        <?php endif; ?>
                    </h5>
                    <div
                            style="height: 15.5rem; border: 1px solid #373b3e; background-color: #212529; pointer-events: none; user-select: none;"
                            class="d-flex align-items-center justify-content-center text-uppercase fw-bold fs-5"
                            id=<?= 'schedule' . $model->id ?>
                    >
                        Выходной
                    </div>
                </div>
            <?php elseif (!$isVacation): ?>
                <div class="col-xxl-6 mb-4 px-3">
                    <h5 class="mb-4">
                        <?= "$title | $date" ?>
                        <?php if ($user->isActionAvailable(User::ACTION_CHANGE_SCHEDULE)): ?> |
                            <?= Html::a('Изменить', ['schedule/change', 'type' => 'day', 'id' => $model->id],
                                ['class' => 'link-secondary text-decoration-none']) ?>
                        <?php endif; ?>
                    </h5>
                    <table
                            style="user-select: none"
                            class="table table-bordered table-striped table-hover table-dark"
                            id=<?= 'schedule' . $model->id ?>
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
                            <?php foreach ($model->dayLectures as $dayLecture): ?>
                                <?php
                                $isFree = $dayLecture->isFree;
                                $lectureTime = $dayLecture->time . ':00';
                                $lecture = $dayLecture->lecture;
                                $teacher = $dayLecture->teacher;
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
                                                        'schedule/change',
                                                        'type' => 'lecture',
                                                        'id' => $dayLecture->id
                                                    ],
                                                    ['class' => 'link-primary text-decoration-none']
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
                                                        'schedule/change',
                                                        'type' => 'lecture',
                                                        'id' => $dayLecture->id
                                                    ],
                                                    ['class' => 'link-primary text-decoration-none']
                                                )
                                                ?>
                                            <?php else: ?>
                                                <?= Html::encode($lecture->title) ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="col-3 text-center"><?= Html::encode($teacher->username) ?></td>
                                        <td class="col-1 text-center"><?= date('H:i',
                                                strtotime($lectureTime)) ?></td>
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
                                    <?= $model->type === ScheduleDay::TYPE_ATTESTATION ? 'Аттестация' : 'Экзамен' ?>
                                </td>
                                <td class="col-1 text-center">
                                    <?= "С $model->from:00 до $model->to:00" ?>
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
