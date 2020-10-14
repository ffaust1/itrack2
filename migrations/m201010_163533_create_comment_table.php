<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%contact}}`
 */
class m201010_163533_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'contact_id' => $this->integer()->notNull(),
            'text' => $this->text(),
        ]);

        // creates index for column `contact_id`
        $this->createIndex(
            '{{%idx-comment-contact_id}}',
            '{{%comment}}',
            'contact_id'
        );

        // add foreign key for table `{{%contact}}`
        $this->addForeignKey(
            '{{%fk-comment-contact_id}}',
            '{{%comment}}',
            'contact_id',
            '{{%contact}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%contact}}`
        $this->dropForeignKey(
            '{{%fk-comment-contact_id}}',
            '{{%comment}}'
        );

        // drops index for column `contact_id`
        $this->dropIndex(
            '{{%idx-comment-contact_id}}',
            '{{%comment}}'
        );

        $this->dropTable('{{%comment}}');
    }
}
