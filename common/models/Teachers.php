<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teachers".
 *
 * @property integer $id
 * @property integer $rank_teacher_id
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 *
 * @property Subjects[] $subjects
 * @property RankTeacher $rankTeacher
 */
class Teachers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rank_teacher_id', 'first_name', 'last_name', 'patronymic'], 'required'],
            [['rank_teacher_id'], 'integer'],
            [['first_name', 'last_name', 'patronymic'], 'string', 'max' => 45],
            [['rank_teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => RankTeacher::className(), 'targetAttribute' => ['rank_teacher_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rank_teacher_id' => Yii::t('app', 'Rank Teacher ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'patronymic' => Yii::t('app', 'Patronymic'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(Subjects::className(), ['teachers_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankTeacher()
    {
        return $this->hasOne(RankTeacher::className(), ['id' => 'rank_teacher_id']);
    }

    /**
     * @inheritdoc
     * @return TeachersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TeachersQuery(get_called_class());
    }
}
