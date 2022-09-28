<?php

use app\models\Formation;
use app\models\Status;
use app\models\User;
use app\models\Lecture;
use app\models\StudentVisit;
use app\models\SearchUserForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;

/**
 * @var yii\web\View $this
 * @var Formation[] $formations
 * @var User[] $models
 * @var User $user
 * @var SearchUserForm $formModel
 */

$lectures = Lecture::findAll(['status' => Lecture::STATUS_SUBMITTED]);

$formations = Formation::find()->all();

$formationsItems = ArrayHelper::map($formations, 'id', 'name');

$this->title = 'Vampires Academy | Студенты';
?>

<section>
    <h4 class="mb-3">Студенты Академии Ночи</h4>
    <div class="d-flex flex-row align-items-start justify-content-between">
        <div class="users-list">
            <?php foreach ($models as $model): ?>
                <div class="users-list__wrapper">
                    <div class="users-list__user user <?= $model->id === $user->id ? 'user_active' : '' ?>">
                        <div>
                            <span class="user__name">
                                <?= Html::encode($model->username . ' | ' . $model->formationUsers[0]->formation->name) ?>
                            </span>
                            <span class="user__id"><?= 'ID: ' . Html::encode($model->fivem_id) ?></span>
                            <div class="user-contacts">
                                <span class="user-contacts__element">Discord: <b><?= Html::encode($model->discord) ?></b></span>
                            </div>
                        </div>
                        <div class="user-performance mt-3 invisible" id="performance<?= $model->id ?>">
                            <?php
                            $userVisit = StudentVisit::findOne(['student_id' => $model->id]);
                            ?>
                            <table class="table table-bordered table-striped table-hover table-dark">
                                <thead>
                                <tr>
                                    <th class="col-3">Лекция</th>
                                    <th class="col-1 text-center">Статус</th>
                                    <th class="col-1 text-center">Дата</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($lectures as $lecture): ?>
                                    <?php
                                    $visitedLecture = $model->isLectureVisited($lecture->id);

                                    $status = $visitedLecture ? 'Посещена' : 'Не посещена';

                                    if ($visitedLecture && $visitedLecture->is_individual) {
                                        $status = 'Индивидуально';
                                    }
                                    ?>
                                    <tr>
                                        <td class="col-3"><?= Html::encode("$lecture->id. $lecture->title") ?></td>
                                        <td class="col-1 text-center">
                                            <?= $status ?>
                                        </td>
                                        <td class="col-1 text-center">
                                            <?php if ($visitedLecture): ?>
                                                <?= date('d.m.Y', strtotime($visitedLecture->date)) ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="users-list-control">
                        <div class="user-select-none">
                            <div
                                    class="fs-5 link-secondary text-uppercase fw-bold mb-3"
                                    onclick="changeControls(<?= "performance$model->id" ?>)"
                            >
                                Успеваемость
                            </div>
                        </div>
                        <?php if ($user->status->level > $model->status->level): ?>
                            <div class="user-select-none">
                                <div
                                        class="fs-5 link-secondary text-uppercase fw-bold mb-3"
                                        onclick="changeControls(<?= "user$model->id" ?>)"
                                >
                                    Изменить статус
                                </div>
                                <ul
                                        class="invisible"
                                        id="user<?= $model->id ?>"
                                >
                                    <?php foreach (Status::find()->all() as $status): ?>
                                        <?php if ($status->id !== $model->status->id && $status->level < $user->status->level): ?>
                                            <li>
                                                <?=
                                                Html::a
                                                (
                                                    $status->label,
                                                    [
                                                        'students/change',
                                                        'id' => $model->id,
                                                        'newStatusId' => $status->id
                                                    ],
                                                    ['class' => 'link-secondary text-decoration-none fs-5']
                                                )
                                                ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{input}",
            ]
        ]);
        ?>

        <div class="d-flex flex-column align-items-end">
            <?=
            $form->field($formModel, 'search')
                ->textInput([
                    'autofocus' => true,
                    'onchange' => 'this.form.submit()',
                    'placeholder' => 'Поиск...',
                    'style' => 'width: 25rem; padding: .8rem 1rem; font-size: 1.4rem'
                ]);
            ?>

            <?=
            $form->field($formModel, 'formationIds')
                ->checkboxList($formationsItems, [
                    'itemOptions' => [
                        'onchange' => 'this.form.submit()',
                        'labelOptions' => [
                            'class' => 'mb-1 fs-5 text-uppercase fw-bold mb-3',
                        ],
                        'inputOptions' => [
                            'style' => 'background-color: #ffffff;'
                        ]
                    ]
                ]);
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</section>
