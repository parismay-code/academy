<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lecture_file`.
 * Has foreign keys to the tables:
 *
 * - `lecture`
 * - `file`
 */
class m221031_050313_create_junction_table_for_lecture_and_file_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lecture_file', [
            'lecture_id' => $this->integer(),
            'file_id' => $this->integer(),
            'PRIMARY KEY(lecture_id, file_id)',
        ]);

        // creates index for column `lecture_id`
        $this->createIndex(
            'idx-lecture_file-lecture_id',
            'lecture_file',
            'lecture_id'
        );

        // add foreign key for table `lecture`
        $this->addForeignKey(
            'fk-lecture_file-lecture_id',
            'lecture_file',
            'lecture_id',
            'lecture',
            'id',
            'CASCADE'
        );

        // creates index for column `file_id`
        $this->createIndex(
            'idx-lecture_file-file_id',
            'lecture_file',
            'file_id'
        );

        // add foreign key for table `file`
        $this->addForeignKey(
            'fk-lecture_file-file_id',
            'lecture_file',
            'file_id',
            'file',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `lecture`
        $this->dropForeignKey(
            'fk-lecture_file-lecture_id',
            'lecture_file'
        );

        // drops index for column `lecture_id`
        $this->dropIndex(
            'idx-lecture_file-lecture_id',
            'lecture_file'
        );

        // drops foreign key for table `file`
        $this->dropForeignKey(
            'fk-lecture_file-file_id',
            'lecture_file'
        );

        // drops index for column `file_id`
        $this->dropIndex(
            'idx-lecture_file-file_id',
            'lecture_file'
        );

        $this->dropTable('lecture_file');
    }
}
