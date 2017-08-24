<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Spesiality]].
 *
 * @see Spesiality
 */
class SpesialityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Spesiality[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Spesiality|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
