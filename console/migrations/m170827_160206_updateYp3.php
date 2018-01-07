<?php

use yii\db\Migration;

class m170827_160206_updateYp3 extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('yp3','date', $this->integer(4));
        $this->addColumn('yp3_subjects', 'date', $this->timestamp());
    }

    public function safeDown()
    {
        echo "m170827_160206_updateYp3 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170827_160206_updateYp3 cannot be reverted.\n";

        return false;
    }
    */
}
