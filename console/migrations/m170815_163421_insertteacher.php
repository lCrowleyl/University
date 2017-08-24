<?php

use yii\db\Migration;

class m170815_163421_insertteacher extends Migration
{
    public function safeUp()
    {
        $this->insert('rank_teacher',array(
         'rank_name' =>'Доцент',
         ));
        
        $this->insert('rank_teacher',array(
         'rank_name' =>'Профессор',
         ));
        
        $this->insert('rank_teacher',array(
         'rank_name' =>'Старший преподаватель',
         ));
        
        $this->insert('rank_teacher',array(
         'rank_name' =>'Ассистент',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 1,
         'last_name' => 'Светличная',
         'first_name' => 'Виктория',
         'patronymic' => 'Антоновна',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 1,
         'last_name' => 'Привалов',
         'first_name' => 'Максим',
         'patronymic' => 'Владимирович',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 1,
         'last_name' => 'Мартыненко',
         'first_name' => 'Татьяна',
         'patronymic' => 'Владимировна',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 1,
         'last_name' => 'Васяева',
         'first_name' => 'Татьяна',
         'patronymic' => 'Александровна',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 1,
         'last_name' => 'Ярошенко',
         'first_name' => 'Николай',
         'patronymic' => 'Аленсандрович',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 4,
         'last_name' => 'Бабич',
         'first_name' => 'Кристина',
         'patronymic' => 'Константиновна',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 4,
         'last_name' => 'Матях',
         'first_name' => 'Ирина',
         'patronymic' => 'Владимировна',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 4,
         'last_name' => 'Воронова',
         'first_name' => 'Алена',
         'patronymic' => 'Игоревна',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 4,
         'last_name' => 'Пряхин',
         'first_name' => 'Владимир',
         'patronymic' => 'Викторович',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 1,
         'last_name' => 'Хмелевой',
         'first_name' => 'Сергей',
         'patronymic' => 'Владимирович',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 1,
         'last_name' => 'Савкова',
         'first_name' => 'Елена',
         'patronymic' => 'Осиповна',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 1,
         'last_name' => 'Секирин',
         'first_name' => 'Александр',
         'patronymic' => 'Иванович',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 3,
         'last_name' => 'Поляков',
         'first_name' => 'Александр',
         'patronymic' => 'Иванович',
         ));
                      
        $this->insert('teachers',array(
         'rank_teacher_id' => 4,
         'last_name' => 'Бережной',
         'first_name' => 'Александр',
         'patronymic' => 'Аленсандрович',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 4,
         'last_name' => 'Щуватова',
         'first_name' => 'Екатерина',
         'patronymic' => 'Александровна',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 1,
         'last_name' => 'Землянская',
         'first_name' => 'Светлана',
         'patronymic' => 'Юрьевна',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 3,
         'last_name' => 'Андриевская',
         'first_name' => 'Наталья',
         'patronymic' => 'Климовна',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 3,
         'last_name' => 'Теплова',
         'first_name' => 'Ольга',
         'patronymic' => 'Валентиновна',
         ));
        
        $this->insert('teachers',array(
         'rank_teacher_id' => 3,
         'last_name' => 'Новиков',
         'first_name' => 'Денис',
         'patronymic' => 'Дмитриевич',
         ));
        


    }

    public function safeDown()
    {
        echo "m170815_163421_insertteacher cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170815_163421_insertteacher cannot be reverted.\n";

        return false;
    }
    */
}
