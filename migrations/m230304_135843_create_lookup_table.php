<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lookup}}`.
 */
class m230304_135843_create_lookup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lookup}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'code' => $this->integer()->notNull(),
            'type' => $this->string(128)->notNull(),
            'position' => $this->integer(),
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

        $this->batchInsert('lookup', ['id', 'name', 'type', 'code', 'position'],[
            [1, 'Draft', 'PostStatus', 1, 1],
            [2, 'Published', 'PostStatus', 2, 2],
            [3, 'Archived', 'PostStatus', 3, 3],
            [4, 'Pending Approval', 'CommentStatus', 1, 1],
            [5, 'Approved', 'CommentStatus', 2, 2],
        ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lookup}}');
    }
}
