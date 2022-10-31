<?php

use yii\db\Migration;

/**
 * Handles the creation of table `schedule_day_lecture`.
 * Has foreign keys to the tables:
 *
 * - `schedule_day`
 * - `lecture`
 */
class m221031_050359_create_junction_table_for_schedule_day_and_lecture_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('schedule_day_lecture', [
            'id' => $this->primaryKey(),
            'schedule_day_id' => $this->integer(),
            'lecture_id' => $this->integer(),
            'teacher_id' => $this->integer(),
            'time' => $this->integer(),
            'is_free' => $this->boolean(),
        ]);

        // creates index for column `schedule_day_id`
        $this->createIndex(
            'idx-schedule_day_lecture-schedule_day_id',
            'schedule_day_lecture',
            'schedule_day_id'
        );

        // add foreign key for table `schedule_day`
        $this->addForeignKey(
            'fk-schedule_day_lecture-schedule_day_id',
            'schedule_day_lecture',
            'schedule_day_id',
            'schedule_day',
            'id',
            'CASCADE'
        );

        // creates index for column `lecture_id`
        $this->createIndex(
            'idx-schedule_day_lecture-lecture_id',
            'schedule_day_lecture',
            'lecture_id'
        );

        // add foreign key for table `lecture`
        $this->addForeignKey(
            'fk-schedule_day_lecture-lecture_id',
            'schedule_day_lecture',
            'lecture_id',
            'lecture',
            'id',
            'CASCADE'
        );

        // creates index for column `teacher_id`
        $this->createIndex(
            'idx-schedule_day_lecture-teacher_id',
            'schedule_day_lecture',
            'teacher_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-schedule_day_lecture-teacher_id',
            'schedule_day_lecture',
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
        // drops foreign key for table `schedule_day`
        $this->dropForeignKey(
            'fk-schedule_day_lecture-schedule_day_id',
            'schedule_day_lecture'
        );

        // drops index for column `schedule_day_id`
        $this->dropIndex(
            'idx-schedule_day_lecture-schedule_day_id',
            'schedule_day_lecture'
        );

        // drops foreign key for table `lecture`
        $this->dropForeignKey(
            'fk-schedule_day_lecture-lecture_id',
            'schedule_day_lecture'
        );

        // drops index for column `lecture_id`
        $this->dropIndex(
            'idx-schedule_day_lecture-lecture_id',
            'schedule_day_lecture'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-schedule_day_lecture-teacher_id',
            'schedule_day_lecture'
        );

        // drops index for column `teacher_id`
        $this->dropIndex(
            'idx-schedule_day_lecture-teacher_id',
            'schedule_day_lecture'
        );

        $this->dropTable('schedule_day_lecture');
    }
}
