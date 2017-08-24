<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rank_teacher".
 *
 * @property integer $id
 * @property string $rank_name
 *
 * @property Teachers[] $teachers
 */
class RankTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rank_teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rank_name'], 'required'],
            [['rank_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rank_name' => Yii::t('app', 'Rank Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teachers::className(), ['rank_teacher_id' => 'id']);
    }
}
