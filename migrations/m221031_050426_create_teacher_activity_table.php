<?php

use yii\db\Migration;

/**
 * Handles the creation of table `teacher_activity`.
 */
class m221031_050426_create_teacher_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('teacher_activity', [
            'id' => $this->primaryKey(),
            'teacher_id' => $this->integer()->notNull(),
            'type' => $this->string(),
            'date' => $this->dateTime()
        ]);

        // creates index for column `teacher_id`
        $this->createIndex(
            'idx-teacher_activity-teacher_id',
            'teacher_activity',
            'teacher_id'
        );

        // add foreign key for table `lecture`
        $this->addForeignKey(
            'fk-teacher_activity-teacher_id',
            'teacher_activity',
            'teacher_id',
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
        $this->dropForeignKey(
            'fx-teacher_activity-teacher_id',
            'teacher_activity'
        );

        $this->dropIndex(
            'idx-teacher_activity-teacher_id',
            'teacher_activity'
        );

        $this->dropTable('teacher_activity');
    }
}
