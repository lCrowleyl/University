<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "direction".
 *
 * @property integer $id
 * @property string $name_direction
 * @property string $cypher
 *
 * @property Flows[] $flows
 * @property Plan[] $plans
 */
class Direction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'direction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_direction', 'cypher'], 'required'],
            [['name_direction'], 'string', 'max' => 150],
            [['cypher'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_direction' => Yii::t('app', 'Name Direction'),
            'cypher' => Yii::t('app', 'Cypher'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlows()
    {
        return $this->hasMany(Flows::className(), ['direction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['direction_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return DirectionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DirectionQuery(get_called_class());
    }
}
