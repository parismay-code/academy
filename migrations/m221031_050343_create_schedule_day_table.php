<?php

use yii\db\Migration;

/**
 * Handles the creation of table `schedule_day`.
 */
class m221031_050343_create_schedule_day_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('schedule_day', [
            'id' => $this->primaryKey(),
            'type' => $this->string(),
            'day' => $this->integer()->notNull(),
            'evening' => $this->integer()->notNull()
        ]);

        $this->batchInsert('schedule_day', ['type', 'day', 'evening'], [
            ['lecture', '14', '20'],
            ['vacation', '14', '20'],
            ['lecture', '14', '20'],
            ['vacation', '14', '20'],
            ['lecture', '14', '20'],
            ['lecture', '14', '20'],
            ['examination', '14', '20'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('schedule_day');
    }
}
