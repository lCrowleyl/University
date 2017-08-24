<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Contingent]].
 *
 * @see Contingent
 */
class ContingentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Contingent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Contingent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
