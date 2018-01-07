<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subjects_info".
 *
 * @property integer $id
 * @property integer $subjects_id
 * @property integer $plan_id
 * @property integer $part_cycle_id
 * @property integer $semestr
 * @property integer $status
 * @property integer $lecture_time
 * @property integer $labs_time
 * @property integer $practical_time
 * @property integer $exam
 * @property integer $credit
 * @property integer $differentiated_credit
 * @property integer $cource_work
 * @property integer $cource_project
 * @property integer $individual_assignment
 * @property integer $summ_time
 *
 * @property PartCycle $partCycle
 * @property Plan $plan
 * @property Subjects $subjects
 * @property Yp3Subjects[] $yp3Subjects
 */


class SubjectsInfo extends \yii\db\ActiveRecord
{
    public static $planInfoTitles = [
        'lecture_time' => 'лек.',
        'labs_time' => 'лаб.',
        'practical_time' => 'прак.',
        'exam' => 'экзамен',
        'credit' => 'зачет',
        'differentiated_credit' => 'диф. за-чет',
        'cource_work' =>'курсовая работа',
        'cource_project' => 'курсовой проект',
        'individual_assignment' =>'индивидуальные задания',
        'summ_time' => 'всего (часы)',
        
        
        
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subjects_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subjects_id', 'semestr', 'summ_time'], 'required'],
            [['subjects_id', 'plan_id', 'part_cycle_id', 'semestr', 'status', 'lecture_time', 'labs_time', 'practical_time', 'exam', 'credit', 'differentiated_credit', 'cource_work', 'cource_project', 'individual_assignment', 'summ_time'], 'integer'],
            [['part_cycle_id'], 'exist', 'skipOnError' => true, 'targetClass' => PartCycle::className(), 'targetAttribute' => ['part_cycle_id' => 'id']],
            [['plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plan::className(), 'targetAttribute' => ['plan_id' => 'id']],
            [['subjects_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::className(), 'targetAttribute' => ['subjects_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subjects_id' => Yii::t('app', 'Subjects ID'),
            'plan_id' => Yii::t('app', 'Plan ID'),
            'part_cycle_id' => Yii::t('app', 'Part Cycle ID'),
            'semestr' => Yii::t('app', 'Semestr'),
            'status' => Yii::t('app', 'Status'),
            'lecture_time' => Yii::t('app', 'Lecture Time'),
            'labs_time' => Yii::t('app', 'Labs Time'),
            'practical_time' => Yii::t('app', 'Practical Time'),
            'exam' => Yii::t('app', 'Exam'),
            'credit' => Yii::t('app', 'Credit'),
            'differentiated_credit' => Yii::t('app', 'Differentiated Credit'),
            'cource_work' => Yii::t('app', 'Cource Work'),
            'cource_project' => Yii::t('app', 'Cource Project'),
            'individual_assignment' => Yii::t('app', 'Individual Assignment'),
            'summ_time' => Yii::t('app', 'Summ Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartCycle()
    {
        return $this->hasOne(PartCycle::className(), ['id' => 'part_cycle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['id' => 'plan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjects()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subjects_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYp3Subjects()
    {
        return $this->hasMany(Yp3Subjects::className(), ['subjects_info_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SubjectsInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubjectsInfoQuery(get_called_class());
    }
}
