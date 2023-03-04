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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lookup}}');
    }
}
