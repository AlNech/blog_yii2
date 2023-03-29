<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_tag}}`.
 */
class m230329_213715_create_post_tag_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('post_tag', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-post_post_id',
            'post_tag',
            'post_id',
        );

        $this->addForeignKey(
            'tag_post_post_id',
            'post_tag',
            'post_id',
            'post',
            'id',
            'CASCADE',
        );

        //-------------------------//
        $this->createIndex(
            'idx-tag_id',
            'post_tag',
            'tag_id',
        );

        $this->addForeignKey(
            'fk-tag_id',
            'post_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('post_tag');
    }
}
