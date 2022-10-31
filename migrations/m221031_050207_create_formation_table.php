<?php

use yii\db\Migration;

/**
 * Handles the creation of table `formation`.
 */
class m221031_050207_create_formation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('formation', [
            'id' => $this->primaryKey(),
            'name' => $this->string(['length' => 128]),
            'leader_name' => $this->string(['length' => 128]),
            'deputy_leader_name' => $this->string(['length' => 128]),
            'lawyer_name' => $this->string(['length' => 128]),
        ]);

        $this->batchInsert('formation', ['name', 'leader_name', 'deputy_leader_name', 'lawyer_name'], [
            ['Insignis', 'Nathan Young', 'Axel Shax', 'Jacqueline de Monroe'],
            ['Camarilla', 'Gunter Knapp', 'Mikaella Teller', 'Mateo Gerrera'],
            ['Caedes', 'Scott Sewell', 'David Brown', 'Desmond O. Russell'],
            ['Sabbat', 'Schwein Fettes', 'Wendy Farrel Osborn', 'Dustin Ross'],
            ['Gangrel', 'Aaron de Langeron', 'Aldo Chelsea', 'Francis de Castan'],
        ]);

        $this->insert('formation', ['name' => 'King`s Landing', 'leader_name' => 'Victoria de Langeron']);
        $this->insert('formation', ['name' => 'Условно-свободный вампир']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('formation');
    }
}
