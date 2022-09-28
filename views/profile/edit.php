<?php

use app\models\User;
use app\models\Formation;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\ProfileChangeForm;

/**
 * @var yii\web\View $this
 * @var User $user
 */

$formations = Formation::find()->all();
$items = ArrayHelper::map($formations, 'id', 'name');

$this->title = 'Vampires Academy | Профиль';
?>

<section>
    <h4 class="mb-3">Редактирование профиля <?= Html::encode($user->username) ?></h4>
    <?php $form = ActiveForm::begin([
        'id' => 'profile-change-form',
        'options' => ['class' => 'w-75 m-auto mt-5'],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{hint}\n{error}",
        ],
    ]); ?>

    <?=
    $form->field($user, 'username')
        ->textInput([
            'placeholder' => 'Имя',
            'autofocus' => true,
        ])
        ->label('Новое имя Вашего персонажа');
    ?>
    <?=
    $form->field($user, 'fivem_id')
        ->input('number', [
            'min' => '1',
            'max' => '999999',
            'placeholder' => 'FiveM ID',
        ])
        ->label('Ваш ID на сервере');
    ?>
    <?=
    $form->field($user, 'discord')
        ->textInput(['placeholder' => 'Discord'])
        ->hint('example#9999')
        ->label('Ваш новый Discord (с тегом)');
    ?>
    <?=
    $form->field($user, 'formation_id')
        ->dropDownList($items)
        ->label('Выберите свою новую формацию');
    ?>
    <?=
    $form->field($user, 'new_password')
        ->passwordInput([
            'placeholder' => 'Пароль',
        ])
        ->label('Введите новый пароль');
    ?>
    <?=
    $form->field($user, 'password_repeat')
        ->passwordInput([
            'placeholder' => 'Пароль',
        ])
        ->label('Повторите новый пароль');
    ?>
    <?=
    $form->field($user, 'password')
        ->passwordInput([
            'placeholder' => 'Пароль',
        ])
        ->label('Введите пароль');
    ?>

    <?= Html::submitInput('Изменить', [
        'class' => 'btn btn-success text-white text-uppercase text-decoration-none fs-5 p-2 fw-bold w-100',
        'name' => 'submit-button'
    ]) ?>
    <?php ActiveForm::end(); ?>
</section>
