<?php

use yii\db\Migration;

class m171023_193425_fixed_yp3_subj extends Migration
{
    public function safeUp()
    {
        $this->addColumn('yp3_subjects', 'lections', $this->integer());
        $this->addColumn('yp3_subjects', 'pract', $this->integer());
        $this->addColumn('yp3_subjects', 'labs', $this->integer());
        $this->addColumn('yp3_subjects', 'nirs', $this->integer());
        $this->addColumn('yp3_subjects', 'kontz_zao', $this->integer());
        $this->addColumn('yp3_subjects', 'kons', $this->integer());
        $this->addColumn('yp3_subjects', 'ekzam_kons', $this->integer());
        $this->addColumn('yp3_subjects', 'kontr', $this->integer());
        $this->addColumn('yp3_subjects', 'kyrs', $this->integer());
        $this->addColumn('yp3_subjects', 'zach', $this->integer());
        $this->addColumn('yp3_subjects', 'eczam', $this->integer());
        $this->addColumn('yp3_subjects', 'practic', $this->integer());
        $this->addColumn('yp3_subjects', 'recen', $this->integer());
        $this->addColumn('yp3_subjects', 'dr', $this->integer());
        $this->addColumn('yp3_subjects', 'all', $this->integer());
        
    }

    public function safeDown()
    {
        echo "m171023_193425_fixed_yp3_subj cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171023_193425_fixed_yp3_subj cannot be reverted.\n";

        return false;
    }
    */
}
