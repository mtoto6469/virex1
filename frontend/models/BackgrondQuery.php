<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Backgrond]].
 *
 * @see Backgrond
 */
class BackgrondQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Backgrond[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Backgrond|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
