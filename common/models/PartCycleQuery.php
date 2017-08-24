<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PartCycle]].
 *
 * @see PartCycle
 */
class PartCycleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PartCycle[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PartCycle|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
