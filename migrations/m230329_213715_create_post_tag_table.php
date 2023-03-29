<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_tag}}`.
 */
class m230329_213715_create_post_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_tag}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post_tag}}');
    }
}
