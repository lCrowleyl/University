<?php

use yii\db\Migration;
//use Yii;

class m170815_170102_insert_user extends Migration
{
    public function safeUp()
    {
        $this->insert('user',array(
         'username' => 'admin',
         'auth_key' => 'PhWV3DB3o7W88P9k5UUzWLPOK-QvmfHh',   
         'status' => 10,
         'password_hash' =>  Yii::$app->security->generatePasswordHash('admin12'),
         'email' => 'novikov.d92@mai.ru',
         'created_at' => 1502705799,
         'updated_at' => 1502705799,
         ));
            
            
    }

    public function safeDown()
    {
        echo "m170815_170102_insert_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170815_170102_insert_user cannot be reverted.\n";

        return false;
    }
    */
}
