<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\User;

/**
 * @var yii\web\View $this
 * @var User $user
 * @var ActiveForm $form
 */

$this->title = 'Vampires Academy | Вход';
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'w-75 m-auto mt-5'],
    'fieldConfig' => [
        'template' => "{input}\n{error}",
    ],
]); ?>

<?=
$form->field($user, 'fivem_id')
    ->input('number', [
        'min' => '1',
        'max' => '999999',
        'placeholder' => 'Ваш ID на сервере',
        'autofocus' => true,
    ]);
?>
<?=
$form->field($user, 'password')
    ->passwordInput([
        'placeholder' => 'Пароль',
    ]);
?>

<?= Html::submitInput('Войти', ['class' => 'btn btn-success text-white text-uppercase text-decoration-none font-weight-bold fs-5 p-2 fw-bold w-100', 'name' => 'login-button']) ?>

    <div class="p-5 d-flex align-items-center justify-content-center">
        <?=
        Html::a
        (
            'Еще нет аккаунта?',
            ['auth/registration'],
            ['class' => 'text-decoration-none fs-5 link-secondary p-3']
        )
        ?>
    </div>
<?php ActiveForm::end(); ?>