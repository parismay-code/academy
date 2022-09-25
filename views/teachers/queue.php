<?php

use app\models\TeacherQueue;
use app\models\User;
use app\models\FormationUser;
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
        <div class="teachers-request__list">
            <?php foreach ($models as $model): ?>
                <?php
                $candidate = $model->user;

                $formation = FormationUser::findOne(['user_id' => $candidate->id])->formation;
                ?>
                <div class="teachers-request-user w-75">
                    <span class="teachers-request-user__name">
                        <?=
                        "#$model->id | " .
                        User::STATUS_MAP[$candidate->status]['name'] .
                        ' ' . Html::encode($candidate->username) .
                        ' | ' . Html::encode($formation->name)
                        ?>
                    </span>
                    <span class="teachers-request-user__id">
                        <?= 'ID: ' . Html::encode($candidate->fivem_id) ?>
                    </span>
                    <div class="teachers-request-user-contacts">
                        <span class="teachers-request-user-contacts__element">
                            Discord: <b><?= Html::encode($candidate->discord) ?></b>
                        </span>
                    </div>
                </div>
                <div class="teachers-request-controls mt-3">
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
