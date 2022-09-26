<?php

use app\models\Formation;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Status;

/** @var yii\web\View $this
 * @var app\models\LoginForm $model
 * @var ActiveForm $form
 */

$this->title = 'Vampires Academy | Регистрация';
?>

<?php $form = ActiveForm::begin([
    'id' => 'registration-form',
    'options' => ['class' => 'w-75 m-auto mt-5'],
    'fieldConfig' => [
        'template' => "{input}\n{error}\n{hint}",
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

<?= $form->field($model, 'statusId')->dropDownList([
    0 => Status::findOne(['level' => 0])->label,
    1 => Status::findOne(['level' => 1])->label,
]); ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль']) ?>

<?= $form->field($model, 'repeatPassword')->passwordInput(['placeholder' => 'Повторите пароль']) ?>

<?php
$formations = Formation::find()->all();
$items = ArrayHelper::map($formations, 'id', 'name');
?>

<?= $form->field($model, 'formationId')->dropDownList($items) ?>

<?= Html::submitInput('Зарегистрироваться',
    ['class' => 'btn btn-success text-white text-uppercase text-decoration-none font-weight-bold fs-5 p-2 fw-bold w-100', 'name' => 'registration-button']) ?>

    <div class="p-5 d-flex align-items-center justify-content-center">
        <?=
        Html::a
        (
            'Вход в аккаунт',
            ['auth/index'],
            ['class' => 'text-decoration-none fs-5 link-secondary p-3']
        )
        ?>
    </div>
<?php ActiveForm::end(); ?>