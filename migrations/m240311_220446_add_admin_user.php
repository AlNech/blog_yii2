<?php

use yii\db\Migration;

/**
 * Class m240311_220446_add_admin_user
 */
class m240311_220446_add_admin_user extends Migration
{
    const TABLE_NAME = 'user';

    public function up()
    {
        $this->insert(self::TABLE_NAME, [
            'name' =>   'admin',
            'isAdmin'=> 1,
            'email' => 'admin@yoursite.ru',
            'password' => Yii::$app->security->generatePasswordHash('admin')
        ]);
    }

    public function down()
    {
        $this->delete(self::TABLE_NAME, ['name' => 'admin']);
    }
}
