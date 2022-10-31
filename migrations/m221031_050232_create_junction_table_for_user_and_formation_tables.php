<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_formation`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `formation`
 */
class m221031_050232_create_junction_table_for_user_and_formation_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_formation', [
            'user_id' => $this->integer(),
            'formation_id' => $this->integer(),
            'PRIMARY KEY(user_id, formation_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_formation-user_id',
            'user_formation',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'fk-user_formation-user_id',
            'user_formation',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `formation_id`
        $this->createIndex(
            'idx-user_formation-formation_id',
            'user_formation',
            'formation_id'
        );

        // add foreign key for table `formation`
        $this->addForeignKey(
            'fk-user_formation-formation_id',
            'user_formation',
            'formation_id',
            'formation',
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
            'fk-user_formation-user_id',
            'user_formation'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_formation-user_id',
            'user_formation'
        );

        // drops foreign key for table `formation`
        $this->dropForeignKey(
            'fk-user_formation-formation_id',
            'user_formation'
        );

        // drops index for column `formation_id`
        $this->dropIndex(
            'idx-user_formation-formation_id',
            'user_formation'
        );

        $this->dropTable('user_formation');
    }
}
