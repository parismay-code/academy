<?php

use yii\db\Migration;

/**
 * Handles the creation of table `student_visit`.
 */
class m221031_050413_create_student_visit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('student_visit', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer()->notNull(),
            'lecture_id' => $this->integer()->notNull(),
            'is_individual' => $this->boolean(),
            'date' => $this->dateTime()
        ]);

        // creates index for column `student_id`
        $this->createIndex(
            'idx-student_visit-student_id',
            'student_visit',
            'student_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-student_visit-student_id',
            'student_visit',
            'student_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `lecture_id`
        $this->createIndex(
            'idx-student_visit-lecture_id',
            'student_visit',
            'lecture_id'
        );

        // add foreign key for table `lecture`
        $this->addForeignKey(
            'fk-student_visit-lecture_id',
            'student_visit',
            'lecture_id',
            'lecture',
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
            'fk-student_visit-student_id',
            'student_visit'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            'idx-student_visit-student_id',
            'student_visit'
        );

        // drops foreign key for table `lecture`
        $this->dropForeignKey(
            'fk-student_visit-lecture_id',
            'student_visit'
        );

        // drops index for column `lecture_id`
        $this->dropIndex(
            'idx-student_visit-lecture_id',
            'student_visit'
        );

        $this->dropTable('student_visit');
    }
}
