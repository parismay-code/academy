<?php

use app\models\TeacherQueue;
use app\models\User;
use app\models\UserFormation;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var TeacherQueue[] $models
 * @var User $user
 */

$this->title = 'Vampires Academy | Заявки';
?>

    <section>
        <h4 class="mb-5">Заявки в преподавательский состав Академии Ночи</h4>
        <div class="users-request__list">
            <?php foreach ($models as $model): ?>
                <?php
                $candidate = $model->user;

                $formation = UserFormation::findOne(['user_id' => $candidate->id])->formation;
                ?>
                <div class="users-request-user w-75">
                    <span class="users-request-user__name">
                        <?=
                        Html::encode("#$model->id | " . $candidate->status->label . " $candidate->username | $formation->name");
                        ?>
                    </span>
                    <span class="users-request-user__id">
                        <?= 'ID: ' . Html::encode($candidate->fivem_id) ?>
                    </span>
                    <div class="users-request-user-contacts">
                        <span class="users-request-user-contacts__element">
                            Discord: <b><?= Html::encode($candidate->discord) ?></b>
                        </span>
                    </div>
                </div>
                <div class="users-request-controls mt-3">
                    <?=
                    Html::a
                    (
                        'Принять',
                        ['teachers/accept', 'id' => $model->id],
                        ['class' => 'link-success fw-bold fs-5 p-3 text-decoration-none text-uppercase']
                    );
                    ?>
                    <?=
                    Html::a
                    (
                        'Отклонить',
                        ['teachers/decline', 'id' => $model->id],
                        ['class' => 'link-danger fw-bold fs-5 p-3 text-decoration-none text-uppercase']
                    );
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php
