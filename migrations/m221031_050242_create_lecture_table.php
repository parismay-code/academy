<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lecture`.
 */
class m221031_050242_create_lecture_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lecture', [
            'id' => $this->primaryKey(),
            'status' => $this->string(),
            'creation_date' => $this->dateTime(),
            'title' => $this->string(),
            'details' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lecture');
    }
}
