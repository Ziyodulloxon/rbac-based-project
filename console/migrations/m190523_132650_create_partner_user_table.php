<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partner_user}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%partner}}`
 * - `{{%user}}`
 */
class m190523_132650_create_partner_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partner_user}}', [
            'id' => $this->primaryKey(),
            'partner_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `partner_id`
        $this->createIndex(
            '{{%idx-partner_user-partner_id}}',
            '{{%partner_user}}',
            'partner_id'
        );

        // add foreign key for table `{{%partner}}`
        $this->addForeignKey(
            '{{%fk-partner_user-partner_id}}',
            '{{%partner_user}}',
            'partner_id',
            '{{%partner}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-partner_user-user_id}}',
            '{{%partner_user}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-partner_user-user_id}}',
            '{{%partner_user}}',
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
        // drops foreign key for table `{{%partner}}`
        $this->dropForeignKey(
            '{{%fk-partner_user-partner_id}}',
            '{{%partner_user}}'
        );

        // drops index for column `partner_id`
        $this->dropIndex(
            '{{%idx-partner_user-partner_id}}',
            '{{%partner_user}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-partner_user-user_id}}',
            '{{%partner_user}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-partner_user-user_id}}',
            '{{%partner_user}}'
        );

        $this->dropTable('{{%partner_user}}');
    }
}
