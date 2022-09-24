<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LoginForm $model */
/** @var ActiveForm $form */

$this->title = 'Vampires Academy | Вход';
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal',
    'options' => ['class' => 'w-75 m-auto mt-5'],
    'fieldConfig' => [
        'template' => "{beginWrapper}\n{input}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'wrapper' => '',
        ],
    ],
]); ?>

<?=
$form->field($model, 'fivemId')
    ->input('number', [
        'min' => '1',
        'max' => '999999',
        'placeholder' => 'Ваш ID на сервере',
        'autofocus' => true,
    ]);
?>

<?=
$form->field($model, 'password')
    ->passwordInput([
        'placeholder' => 'Пароль',
    ]);
?>

<?= Html::submitInput('Войти', ['class' => 'btn btn-outline-success w-100 p-3', 'name' => 'login-button']) ?>

    <div class="p-5 d-flex align-items-center justify-content-center">
        <?=
        Html::a
        (
            'Еще нет аккаунта?',
            ['auth/registration'],
            ['class' => 'text-white text-decoration-none fs-5 link-secondary p-3']
        )
        ?>
    </div>
<?php ActiveForm::end(); ?>