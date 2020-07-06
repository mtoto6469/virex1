<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Factoradvertise]].
 *
 * @see Factoradvertise
 */
class FactoradvertiseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Factoradvertise[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Factoradvertise|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
