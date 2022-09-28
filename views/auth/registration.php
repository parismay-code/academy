<?php

use app\models\Formation;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Status;

/**
 * @var yii\web\View $this
 * @var User $user
 * @var ActiveForm $form
 */

$formations = Formation::find()->all();
$items = ArrayHelper::map($formations, 'id', 'name');

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

<?= $form->field($user, 'fivem_id')
    ->input('number', [
        'min' => '1',
        'max' => '999999',
        'placeholder' => 'Ваш ID на сервере',
        'autofocus' => true,
    ]);
?>
<?= $form->field($user, 'username')->textInput(['placeholder' => 'Имя персонажа']) ?>
<?= $form->field($user, 'discord')->textInput(['placeholder' => 'Discord'])->hint('example#9999') ?>
<?= $form->field($user, 'status_id')->dropDownList([
    1 => Status::findOne(['level' => 0])->label,
    2 => Status::findOne(['level' => 1])->label,
]); ?>
<?= $form->field($user, 'password')->passwordInput(['placeholder' => 'Пароль']) ?>
<?= $form->field($user, 'password_repeat')->passwordInput(['placeholder' => 'Повторите пароль']) ?>
<?= $form->field($user, 'formation_id')->dropDownList($items) ?>

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