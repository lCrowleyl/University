<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property integer $id
 * @property integer $spesiality_id
 * @property string $plan_number
 * @property string $form_of_training
 * @property string $level_of_training
 *
 * @property Spesiality $spesiality
 * @property SubjectsInfo[] $subjectsInfos
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spesiality_id', 'form_of_training', 'level_of_training','year'], 'required'],
            [['spesiality_id'], 'integer'],
            [['plan_number'], 'string', 'max' => 20],
            [['form_of_training', 'level_of_training'], 'string', 'max' => 200],
            [['year'], 'integer'],
            [['spesiality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Spesiality::className(), 'targetAttribute' => ['spesiality_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'spesiality_id' => Yii::t('app', 'Spesiality ID'),
            'plan_number' => Yii::t('app', 'Plan Number'),
            'form_of_training' => Yii::t('app', 'Form Of Training'),
            'level_of_training' => Yii::t('app', 'Level Of Training'),
            'year' => Yii::t('app', 'Year'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpesiality()
    {
        return $this->hasOne(Spesiality::className(), ['id' => 'spesiality_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectsInfos()
    {
        return $this->hasMany(SubjectsInfo::className(), ['plan_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PlanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanQuery(get_called_class());
    }
}
