<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "diplomniks".
 *
 * @property integer $id
 * @property integer $teachers_id
 * @property integer $flow_id
 * @property integer $count
 *
 * @property Flows $flow
 * @property Teachers $teachers
 */
class Diplomniks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'diplomniks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teachers_id', 'flow_id', 'count'], 'integer'],
            [['flow_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flows::className(), 'targetAttribute' => ['flow_id' => 'id']],
            [['teachers_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::className(), 'targetAttribute' => ['teachers_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teachers_id' => 'Teachers ID',
            'flow_id' => 'Flow ID',
            'count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlow()
    {
        return $this->hasOne(Flows::className(), ['id' => 'flow_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasOne(Teachers::className(), ['id' => 'teachers_id']);
    }
}
