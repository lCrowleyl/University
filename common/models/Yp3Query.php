<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Yp3]].
 *
 * @see Yp3
 */
class Yp3Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Yp3[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Yp3|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
