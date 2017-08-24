<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property integer $id
 * @property integer $flows_id
 * @property string $name_group
 *
 * @property Contingent[] $contingents
 * @property Flows $flows
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flows_id'], 'integer'],
            [['name_group'], 'string', 'max' => 5],
            [['flows_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flows::className(), 'targetAttribute' => ['flows_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'flows_id' => Yii::t('app', 'Flows ID'),
            'name_group' => Yii::t('app', 'Name Group'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContingents()
    {
        return $this->hasMany(Contingent::className(), ['groups_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlows()
    {
        return $this->hasOne(Flows::className(), ['id' => 'flows_id']);
    }

    /**
     * @inheritdoc
     * @return GroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupsQuery(get_called_class());
    }
}
