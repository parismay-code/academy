<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status`.
 */
class m221031_050131_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('status', [
            'id' => $this->primaryKey(),
            'name' => $this->string(['length' => 32]),
            'label' => $this->string(['length' => 32]),
            'level' => $this->integer()
        ]);

        $this->batchInsert('status', ['name', 'label', 'level'], [
            ['visitor', 'Посетитель', '0',],
            ['student', 'Студент', '1',],
            ['assistant', 'Ассистент', '2',],
            ['teacher', 'Преподаватель', '3',],
            ['master', 'Магистр', '4',],
            ['dean', 'Декан', '5',],
            ['vice-rector', 'Проректор', '6',],
            ['rector', 'Ректор', '7',],
            ['admin', 'Администратор', '8',],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('status');
    }
}
