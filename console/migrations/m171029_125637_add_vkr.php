<?php

use yii\db\Migration;

class m171029_125637_add_vkr extends Migration
{
    public function safeUp()
    {

         $this->addColumn('yp3_subjects', 'vkr', $this->integer());
          $this->addColumn('yp4_subjects', 'vkr', $this->integer());
    }

    public function safeDown()
    {
        echo "m171029_125637_add_vkr cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171029_125637_add_vkr cannot be reverted.\n";

        return false;
    }
    */
}
