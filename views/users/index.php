<?php

use app\models\Status;
use app\models\User;
use app\models\Formation;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use app\models\SearchUserForm;

/**
 * @var yii\web\View $this
 * @var User[] $models
 * @var User $user
 * @var SearchUserForm $formModel
 */

$formations = Formation::find()->all();

$formationsItems = ArrayHelper::map($formations, 'id', 'name');

$this->title = 'Vampires Academy | Пользователи';
?>

<section>
    <h4 class="mb-3">Пользователи</h4>
    <div class="d-flex flex-row align-items-start justify-content-between">
        <div class="users-list">
        <?php foreach ($models as $model): ?>
            <div class="users-list__wrapper">
                <div class="users-list__user user <?= $model->id === $user->id ? 'user_active' : '' ?>">
                    <span class="user__name">
                        <?= Html::encode($model->status->label . " $model->username | " . $model->formationUsers[0]->formation->name); ?>
                    </span>
                    <span class="user__id">
                        <?= 'ID: ' . Html::encode($model->fivem_id) ?>
                    </span>
                    <div class="user-contacts">
                        <span class="user-contacts__element">
                            Discord: <b><?= Html::encode($model->discord) ?></b>
                        </span>
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
                                                'users/change',
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
