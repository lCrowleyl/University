<?php

use yii\db\Migration;

class m170817_171110_insertPartCycle extends Migration
{
    public function safeUp()
    {
        
        $this->insert('part_cycle',array(
         'id_part' => 1,
         'name_part' => 'Базовая часть',
         'id_cycle' => 1.1,
         'name_cycle' => 'Гуманитарный, социальный и экономический цикл',
         'id_subcycle' => '',
         'name_subcycle' => '',
         ));
        
        $this->insert('part_cycle',array(
         'id_part' => 1,
         'name_part' => 'Базовая часть',
         'id_cycle' => 1.2,
         'name_cycle' => 'Математический и естественно-научный цикл',
         'id_subcycle' => '',
         'name_subcycle' => '',
         ));
        
        $this->insert('part_cycle',array(
         'id_part' => 1,
         'name_part' => 'Базовая часть',
         'id_cycle' => 1.3,
         'name_cycle' => 'Профессиональный цикл',
         'id_subcycle' => '',
         'name_subcycle' => '',
         ));
        
        $this->insert('part_cycle',array(
         'id_part' => 2,
         'name_part' => 'Вариативная часть',
         'id_cycle' => 2.1,
         'name_cycle' => 'Дисциплины по выбору вуза',
         'id_subcycle' => '2.1.1',
         'name_subcycle' => 'Гуманитарный, социальный и экономический цикл',
         ));
        
        $this->insert('part_cycle',array(
         'id_part' => 2,
         'name_part' => 'Вариативная часть',
         'id_cycle' => 2.1,
         'name_cycle' => 'Дисциплины по выбору вуза',
         'id_subcycle' => '2.1.2',
         'name_subcycle' => 'Математический и естественно-научный цикл',
         ));
        
        $this->insert('part_cycle',array(
         'id_part' => 2,
         'name_part' => 'Вариативная часть',
         'id_cycle' => 2.1,
         'name_cycle' => 'Дисциплины по выбору вуза',
         'id_subcycle' => '2.1.3',
         'name_subcycle' => 'Профессиональный цикл',
         ));
        
        $this->insert('part_cycle',array(
         'id_part' => 2,
         'name_part' => 'Вариативная часть',
         'id_cycle' => 2.2,
         'name_cycle' => 'Дисциплины по выбору студента',
         'id_subcycle' => '2.2.1',
         'name_subcycle' => 'Гуманитарный, социальный и экономический цикл',
         ));
        
        $this->insert('part_cycle',array(
         'id_part' => 2,
         'name_part' => 'Вариативная часть',
         'id_cycle' => 2.2,
         'name_cycle' => 'Дисциплины по выбору студента',
         'id_subcycle' => '2.2.2',
         'name_subcycle' => 'Профессиональный цикл',
         ));
        
        $this->insert('part_cycle',array(
         'id_part' => '',
         'name_part' => '',
         'id_cycle' => 3.1,
         'name_cycle' => 'Цикл вне кредитных дисциплин',
         'id_subcycle' => '',
         'name_subcycle' => '',
         ));
        
        $this->insert('part_cycle',array(
         'id_part' => '',
         'name_part' => '',
         'id_cycle' => 4.1,
         'name_cycle' => 'Практики, в том числе НИР',
         'id_subcycle' => '',
         'name_subcycle' => '',
         ));
        
        $this->insert('part_cycle',array(
         'id_part' => '',
         'name_part' => '',
         'id_cycle' => 5.1,
         'name_cycle' => 'Государственная итоговая аттестация',
         'id_subcycle' => '',
         'name_subcycle' => '',
         ));

    }

    public function safeDown()
    {
        echo "m170817_171110_insertPartCycle cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170817_171110_insertPartCycle cannot be reverted.\n";

        return false;
    }
    */
}
