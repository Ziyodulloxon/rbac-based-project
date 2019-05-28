<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partner}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m190522_155002_create_partner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partner}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(50)->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-partner-user_id}}',
            '{{%partner}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-partner-user_id}}',
            '{{%partner}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-partner-user_id}}',
            '{{%partner}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-partner-user_id}}',
            '{{%partner}}'
        );

        $this->dropTable('{{%partner}}');
    }
}
