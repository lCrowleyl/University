<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "flows".
 *
 * @property integer $id
 * @property integer $direction_id
 * @property string $date
 *
 * @property Direction $direction
 * @property Groups[] $groups
 * @property Yp3Subjects[] $yp3Subjects
 */
class Flows extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flows';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['direction_id'], 'required'],
            [['direction_id'], 'integer'],
            [['date'], 'string', 'max'=>4],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::className(), 'targetAttribute' => ['direction_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'direction_id' => Yii::t('app', 'Direction ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirection()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['flows_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYp3Subjects()
    {
        return $this->hasMany(Yp3Subjects::className(), ['flows_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return FlowsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FlowsQuery(get_called_class());
    }
}
