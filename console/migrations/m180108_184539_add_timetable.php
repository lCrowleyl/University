<?php

use yii\db\Migration;

class m180108_184539_add_timetable extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%timetable}}', [
            'id' => $this->primaryKey(),
            'yp3_subjects' => $this->integer()->notNull(),
            'teachers_id' => $this->integer()->notNull(),
            'week_day' => $this->integer()->notNull(),
            'day_part' => $this->integer()->notNull(),
            'week_type' => $this->integer(1),
        ], $tableOptions);
        
        $this->addForeignKey('fk_timetable_teachers_id',
                '{{%timetable}}', 'teachers_id',
                '{{%teachers}}', 'id',
                'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_timetable_yp3_subjects',
                '{{%timetable}}', 'yp3_subjects',
                '{{%yp3_subjects}}', 'id',
                'CASCADE', 'CASCADE');
        
    }
    
    public function safeDown()
    {
        echo "m180108_184539_add_timetable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180108_184539_add_timetable cannot be reverted.\n";

        return false;
    }
    */
}
