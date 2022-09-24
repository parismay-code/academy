<?php

use app\models\Formation;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this
 * @var app\models\LoginForm $model
 * @var ActiveForm $form
 */

$this->title = 'Vampires Academy | Регистрация';
?>

<?php $form = ActiveForm::begin([
    'id' => 'registration-form',
    'layout' => 'horizontal',
    'options' => ['class' => 'w-75 m-auto mt-5'],
    'fieldConfig' => [
        'template' => "{beginWrapper}\n{input}\n{error}\n{endWrapper}{hint}",
        'horizontalCssClasses' => [
            'wrapper' => '',
            'hint' => 'text-border-info'
        ],
    ],
]); ?>

<div class="col-xl-3"></div>

<?= $form->field($model, 'fivemId')
    ->input('number', [
        'min' => '1',
        'max' => '999999',
        'placeholder' => 'Ваш ID на сервере',
        'autofocus' => true,
    ]);
?>

<?= $form->field($model, 'username')->textInput(['placeholder' => 'Имя персонажа']) ?>

<?= $form->field($model, 'discord')->textInput(['placeholder' => 'Discord'])->hint('example#9999') ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль']) ?>

<?= $form->field($model, 'repeatPassword')->passwordInput(['placeholder' => 'Повторите пароль']) ?>

<?php
$formations = Formation::find()->all();
$items = ArrayHelper::map($formations, 'id', 'name');
?>

<?= $form->field($model, 'formationId')->dropDownList($items) ?>

<?= Html::submitInput('Зарегистрироваться',
    ['class' => 'btn btn-outline-success w-100 p-3', 'name' => 'registration-button']) ?>

    <div class="p-5 d-flex align-items-center justify-content-center">
        <?=
        Html::a
        (
            'Вход в аккаунт',
            ['auth/index'],
            ['class' => 'text-white text-decoration-none fs-5 link-secondary p-3']
        )
        ?>
    </div>
<?php ActiveForm::end(); ?>