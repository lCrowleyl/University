<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contingent".
 *
 * @property integer $id
 * @property integer $groups_id
 * @property integer $count_students
 * @property string $date
 * @property string $password_reset_token
 * @property string $email
 *
 * @property Groups $groups
 */
class Contingent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contingent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groups_id', 'email'], 'required'],
            [['groups_id', 'count_students'], 'integer'],
            [['date'], 'date','format'=>'php:U'],
            [['password_reset_token', 'email'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['groups_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['groups_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'groups_id' => Yii::t('app', 'Groups ID'),
            'count_students' => Yii::t('app', 'Count Students'),
            'date' => Yii::t('app', 'Date'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasOne(Groups::className(), ['id' => 'groups_id']);
    }

    /**
     * @inheritdoc
     * @return ContingentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContingentQuery(get_called_class());
    }
}
