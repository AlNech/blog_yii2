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
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lookup}}');
    }
}
