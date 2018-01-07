<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "yp3_subjects".
 *
 * @property integer $id
 * @property integer $subjects_info_id
 * @property integer $yp3_id
 * @property integer $flows_id
 * @property integer $count_week
 * @property integer $semestr
 * @property string $date
 *
 * @property Flows $flows
 * @property SubjectsInfo $subjectsInfo
 * @property Yp3 $yp3
 */
class Yp3Subjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yp3_subjects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subjects_info_id', 'yp3_id', 'flows_id', 'count_week'], 'required'],
            [['subjects_info_id', 'yp3_id', 'flows_id', 'count_week', 'semestr'], 'integer'],
            [['date'], 'safe'],
            [['flows_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flows::className(), 'targetAttribute' => ['flows_id' => 'id']],
            [['subjects_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubjectsInfo::className(), 'targetAttribute' => ['subjects_info_id' => 'id']],
            [['yp3_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yp3::className(), 'targetAttribute' => ['yp3_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subjects_info_id' => Yii::t('app', 'Subjects Info ID'),
            'yp3_id' => Yii::t('app', 'Yp3 ID'),
            'flows_id' => Yii::t('app', 'Flows ID'),
            'count_week' => Yii::t('app', 'Count Week'),
            'semestr' => Yii::t('app', 'Semestr'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlows()
    {
        return $this->hasOne(Flows::className(), ['id' => 'flows_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectsInfo()
    {
        return $this->hasOne(SubjectsInfo::className(), ['id' => 'subjects_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYp3()
    {
        return $this->hasOne(Yp3::className(), ['id' => 'yp3_id']);
    }

    /**
     * @inheritdoc
     * @return Yp3SubjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new Yp3SubjectsQuery(get_called_class());
    }
}
