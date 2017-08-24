<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subjects".
 *
 * @property integer $id
 * @property integer $teachers_id
 * @property string $name_subject
 * @property integer $is_self
 * @property string $faculty
 *
 * @property Teachers $teachers
 * @property SubjectsInfo[] $subjectsInfos
 */
class Subjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subjects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teachers_id', 'is_self'], 'integer'],
            [['name_subject'], 'required'],
            [['name_subject'], 'string', 'max' => 300],
            [['faculty'], 'string', 'max' => 5],
            [['teachers_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::className(), 'targetAttribute' => ['teachers_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'teachers_id' => Yii::t('app', 'Teachers ID'),
            'name_subject' => Yii::t('app', 'Name Subject'),
            'is_self' => Yii::t('app', 'Is Self'),
            'faculty' => Yii::t('app', 'Faculty'),
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
    public function getSubjectsInfos()
    {
        return $this->hasMany(SubjectsInfo::className(), ['subjects_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SubjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubjectsQuery(get_called_class());
    }
}
