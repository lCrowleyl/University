<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SubjectsInfo]].
 *
 * @see SubjectsInfo
 */
class SubjectsInfoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SubjectsInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SubjectsInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
