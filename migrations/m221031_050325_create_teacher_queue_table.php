<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%teacher_queue}}`.
 */
class m221031_050325_create_teacher_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('teacher_queue', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-teacher_queue-user_id',
            'teacher_queue',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-teacher_queue-user_id',
            'teacher_queue',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-teacher_queue-user_id',
            'teacher_queue'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-teacher_queue-user_id',
            'teacher_queue'
        );

        $this->dropTable('teacher_queue');
    }
}
