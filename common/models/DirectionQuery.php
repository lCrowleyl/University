<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Direction]].
 *
 * @see Direction
 */
class DirectionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Direction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Direction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
