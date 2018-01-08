<?php

use yii\db\Migration;

class m171029_075525_add_diplomniks extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

//        $this->createTable('{{%diplomniks}}', [
//            'id' => $this->primaryKey(),
//            'teachers_id' => $this->integer(),
//            'flow_id' => $this->integer(),
//            'count' => $this->integer(),
//        ], $tableOptions);
//        $this->addForeignKey('fk_diplomniks_teacher_id',
//                '{{%diplomniks}}', 'teachers_id',
//                '{{%teachers}}', 'id',
//                'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_diplomniks_flow_id',
                '{{%diplomniks}}', 'flow_id',
                '{{%flows}}', 'id',
                'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        echo "m171029_075525_add_diplomniks cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171029_075525_add_diplomniks cannot be reverted.\n";

        return false;
    }
    */
}
