<?php

use yii\db\Migration;

class m171023_193650_fixed_flows extends Migration
{
    public function safeUp()
    {
        $this->addColumn('flows', 'facultu', $this->string());
        $this->addColumn('flows', 'cource', $this->integer());
        $this->addColumn('flows', 'student_count', $this->integer());
        $this->addColumn('flows', 'name', $this->string());
        $this->addColumn('flows', 'weeks', $this->integer());   
        $this->addColumn('flows', 'groups', $this->integer());   
        $this->addColumn('flows', 'small_groups', $this->integer());   
    }

    public function safeDown()
    {
        echo "m171023_193650_fixed_flows cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171023_193650_fixed_flows cannot be reverted.\n";

        return false;
    }
    */
}
