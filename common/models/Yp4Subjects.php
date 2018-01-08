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
 *
 * @property Flows $flows
 * @property SubjectsInfo $subjectsInfo
 * @property Yp3 $yp3
 */
class Yp4Subjects extends \yii\db\ActiveRecord
{
    public $count;
    public $teachers_ids;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yp4_subjects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subjects_info_id', 'yp3_id', 'flows_id', 'count_week'], 'required'],
            [['count', 'teachers_ids'], 'safe'],
            [['subjects_info_id', 'yp3_id', 'flows_id', 'count_week', 'semestr'], 'integer'],
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
        return $this->hasOne(Subjects::className(), ['id' => 'subjects_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYpSubjects()
    {
        return $this->hasOne(Yp3Subjects::className(), ['id' => 'yp_subjects_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasOne(Teachers::className(), ['id' => 'teachers_id']);
    }
    
    public static function getTotal($attribute, $ypId, $tId, $semestr) 
    {
        $total = 0;
        $items = Yp4Subjects::find()
            ->leftJoin('yp3_subjects', 'yp3_subjects.id=yp4_subjects.yp_subjects_id') 
            ->leftJoin('yp3', 'yp3_subjects.yp3_id=yp3.id')->where(['yp3_subjects.yp3_id' => $ypId, 'yp3_subjects.semestr' => $semestr])->andWhere(['teachers_id' => $tId])->all();
        foreach ($items as $item) {
            $total += $item->$attribute;
        }
        return $total;
    }

}
