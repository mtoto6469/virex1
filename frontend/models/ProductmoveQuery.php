<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Productmove]].
 *
 * @see Productmove
 */
class ProductmoveQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Productmove[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Productmove|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
