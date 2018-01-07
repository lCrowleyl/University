<?php

use yii\db\Migration;

class m170825_175456_updateGroups extends Migration
{
    public function safeUp()
    {
            $this->alterColumn('groups','name_group', $this->string(16)->notNull()); 
    }

    public function safeDown()
    {
        echo "m170825_175456_updateGroups cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170825_175456_updateGroups cannot be reverted.\n";

        return false;
    }
    */
}
