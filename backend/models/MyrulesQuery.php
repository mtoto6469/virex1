<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Myrules]].
 *
 * @see Myrules
 */
class MyrulesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Myrules[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Myrules|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
