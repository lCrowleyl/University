<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "spesiality".
 *
 * @property integer $id
 * @property integer $direction_id
 * @property string $name_spesiality
 *
 * @property Plan[] $plans
 * @property Direction $direction
 */
class Spesiality extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spesiality';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['direction_id', 'name_spesiality'], 'required'],
            [['direction_id'], 'integer'],
            [['name_spesiality'], 'string', 'max' => 150],
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
            'name_spesiality' => Yii::t('app', 'Name Spesiality'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['spesiality_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirection()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction_id']);
    }

    /**
     * @inheritdoc
     * @return SpesialityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpesialityQuery(get_called_class());
    }
}
