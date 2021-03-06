<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "yp3".
 *
 * @property integer $id
 * @property integer $date
 *
 * @property Yp3Subjects[] $yp3Subjects
 */
class Yp3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yp3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYp3Subjects()
    {
        return $this->hasMany(Yp3Subjects::className(), ['yp3_id' => 'id']);
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
