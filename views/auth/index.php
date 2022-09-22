<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LoginForm $model */
/** @var ActiveForm $form */

$this->title = 'Vampires Academy | Вход';
?>

<main class="container">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <fieldset>
        <legend>Вход в профиль</legend>
        <?= $form->field($model, 'fivemId')
            ->input('number', [
                'min' => '1',
                'max' => '999999',
                'placeholder' => 'Ваш ID на сервере',
                'autofocus' => true,
            ]);
        ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= Html::submitInput('Войти', ['class' => 'btn btn-primary']) ?>
        <br>
        <span class="auth-form__redirect">Еще нет аккаунта?</span>
    </fieldset>
</main>