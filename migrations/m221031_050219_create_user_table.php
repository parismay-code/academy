<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m221031_050219_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'status_id' => $this->integer()->defaultValue('1'),
            'username' => $this->string(['length' => 128]),
            'fivem_id' => $this->integer()->notNull(),
            'discord' => $this->string(['length' => 128]),
            'password' => $this->string(['length' => 128]),
            'registration_date' => $this->dateTime(),
            'auth_key' => $this->string(['length' => 32]),
            'access_token' => $this->string(['length' => 32]),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
