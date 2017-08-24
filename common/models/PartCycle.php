<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "part_cycle".
 *
 * @property integer $id
 * @property integer $id_part
 * @property string $name_part
 * @property double $id_cycle
 * @property string $name_cycle
 * @property double $id_subcycle
 * @property string $name_subcycle
 *
 * @property SubjectsInfo[] $subjectsInfos
 */
class PartCycle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'part_cycle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_part'], 'integer'],
            [['id_cycle'], 'number'],
            [['id_subcycle'], 'string', 'max' => 10],
            [['name_part', 'name_cycle', 'name_subcycle'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_part' => Yii::t('app', 'Id Part'),
            'name_part' => Yii::t('app', 'Name Part'),
            'id_cycle' => Yii::t('app', 'Id Cycle'),
            'name_cycle' => Yii::t('app', 'Name Cycle'),
            'id_subcycle' => Yii::t('app', 'Id Subcycle'),
            'name_subcycle' => Yii::t('app', 'Name Subcycle'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectsInfos()
    {
        return $this->hasMany(SubjectsInfo::className(), ['part_cycle_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PartCycleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PartCycleQuery(get_called_class());
    }
}
