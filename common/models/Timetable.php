<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "timetable".
 *
 * @property integer $id
 * @property integer $yp3_subjects
 * @property integer $teachers_id
 * @property integer $week_day
 * @property integer $day_part
 * @property integer $week_type
 *
 * @property Teachers $teachers
 * @property Yp3Subjects $yp3Subjects
 */
class Timetable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timetable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['yp3_subjects', 'teachers_id', 'week_day', 'day_part'], 'required'],
            [['yp3_subjects', 'teachers_id', 'week_day', 'day_part', 'week_type'], 'integer'],
            [['teachers_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::className(), 'targetAttribute' => ['teachers_id' => 'id']],
            [['yp3_subjects'], 'exist', 'skipOnError' => true, 'targetClass' => Yp3Subjects::className(), 'targetAttribute' => ['yp3_subjects' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'yp3_subjects' => 'Yp3 Subjects',
            'teachers_id' => 'Teachers ID',
            'week_day' => 'Week Day',
            'day_part' => 'Day Part',
            'week_type' => 'Week Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasOne(Teachers::className(), ['id' => 'teachers_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYp3Subjects()
    {
        return $this->hasOne(Yp3Subjects::className(), ['id' => 'yp3_subjects']);
    }
}
