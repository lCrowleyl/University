<?php

use yii\db\Migration;

class m170812_104354_init_tables extends Migration
{
    public function safeUp()
    {
            
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%rank_teacher}}', [
            'id' => $this->primaryKey(),
            'rank_name' => $this->string(45)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%teachers}}', [
            'id' => $this->primaryKey(),
            'rank_teacher_id' => $this->integer()->notNull(),
            'last_name' => $this->string(45)->notNull(),
            'first_name' => $this->string(45)->notNull(),
            'patronymic' => $this->string(45)->notNull(),
        ], $tableOptions);
         
        $this->createTable('{{%subjects}}', [
            'id' => $this->primaryKey(),
            'teachers_id' => $this->integer(),
            'name_subject' => $this->string(300)->notNull(),
            'is_self' => $this->integer(1),
            'faculty' => $this->string(5),
        ], $tableOptions);
        
        $this->createTable('{{%direction}}', [
            'id' => $this->primaryKey(),
            'name_direction' => $this->string(150)->notNull(),
            'cypher' => $this->string(8)->notNull(),
        ], $tableOptions);
        
        $this->createTable('{{%spesiality}}', [
            'id' => $this->primaryKey(),
            'direction_id' => $this->integer()->notNull(),
            'name_spesiality' => $this->string(150)->notNull(),
        ], $tableOptions);
        
        $this->createTable('{{%plan}}', [
            'id' => $this->primaryKey(),
            'spesiality_id' => $this->integer()->notNull(),
            'plan_number' => $this->integer(10),
            'form_of_training' => $this->string(45)->notNull(),
            'level_of_training'=> $this->string(45)->notNull(),
            'year' => $this->integer(4),
        ], $tableOptions);
    
        $this->createTable('{{%subjects_info}}', [
            'id' => $this->primaryKey(),
            'subjects_id' => $this->integer()->notNull(),
            'plan_id' => $this->integer(),
            'part_cycle_id' => $this->integer(),
            'semestr'=> $this->integer(2)->notNull(),
            'status' => $this->integer(1),
            'lecture_time' => $this->integer(4),
            'labs_time' => $this->integer(4),
            'practical_time' => $this->integer(4),
            'exam' => $this->integer(1),
            'credit' => $this->integer(1),
            'differentiated_credit' => $this->integer(1),
            'cource_work' => $this->integer(1),
            'cource_project'=> $this->integer(1),
            'individual_assignment' => $this->integer(1),
            'summ_time'=>$this->integer(10)->notNull(),
        ], $tableOptions);
        
        $this->createTable('{{%part_cycle}}', [
            'id' => $this->primaryKey(),
            'id_part' => $this->integer(),
            'name_part' => $this->string(100),
            'id_cycle' => $this->float(),
            'name_cycle'=> $this->string(100),
            'id_subcycle' => $this->string(10),
            'name_subcycle'=> $this->string(100),
        ], $tableOptions);
           
        $this->createTable('{{%yp3}}', [
            'id' => $this->primaryKey(),
            'date' => $this->timestamp(),
        ], $tableOptions);    

        $this->createTable('{{%flows}}', [
            'id' => $this->primaryKey(),
            'direction_id' => $this->integer()->notNull(),
            'date' => $this->integer(4)->notNull(),
        ], $tableOptions);
                
        $this->createTable('{{%groups}}', [
            'id' => $this->primaryKey(),
            'flows_id' => $this->integer(),
            'name_group' => $this->string(10),
        ], $tableOptions);
       
        $this->createTable('{{%contingent}}', [
            'id' => $this->primaryKey(),
            'groups_id' => $this->integer()->notNull(),
            'count_students' => $this->integer(4),
            'date' => $this->timestamp(),
        ], $tableOptions);
      
        $this->createTable('{{%yp3_subjects}}', [
            'id' => $this->primaryKey(),
            'subjects_info_id' => $this->integer()->notNull(),
            'yp3_id' => $this->integer()->notNull(),
            'flows_id' => $this->integer()->notNull(),
            'count_week' => $this->integer(3)->notNull(),
            'semestr' => $this->integer(1),
        ], $tableOptions);
        
        $this->addForeignKey('fk_teachers_rank_teacher_id',
                '{{%teachers}}', 'rank_teacher_id',
                '{{%rank_teacher}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_subjects_teachers_id',
                '{{%subjects}}', 'teachers_id',
                '{{%teachers}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_spesiality_direction',
                '{{%spesiality}}', 'direction_id',
                '{{%direction}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_plan_spesiality',
                '{{%plan}}', 'spesiality_id',
                '{{%spesiality}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_subjects_info_subjects',
                '{{%subjects_info}}', 'subjects_id',
                '{{%subjects}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_part_cycle_info_subjects',
                '{{%subjects_info}}', 'part_cycle_id',
                '{{%part_cycle}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_subjects_info_plan',
                '{{%subjects_info}}', 'plan_id',
                '{{%plan}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_flows_direction',
                '{{%flows}}', 'direction_id',
                '{{%direction}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_groups_flows',
                '{{%groups}}', 'flows_id',
                '{{%flows}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_contingent_groups',
                '{{%contingent}}','groups_id',
                '{{%groups}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_yp3_subjects_subjects_info',
                '{{%yp3_subjects}}', 'subjects_info_id',
                '{{%subjects_info}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_yp3_subjects_yp3',
                '{{%yp3_subjects}}', 'yp3_id',
                '{{%yp3}}', 'id',
                'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_yp3_subjects_flows',
                '{{%yp3_subjects}}', 'flows_id',
                '{{%flows}}', 'id',
                'CASCADE', 'CASCADE');

    }

    public function safeDown()
    {
        echo "m170812_104354_init_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170812_104354_init_tables cannot be reverted.\n";

        return false;
    }
    */
}
