<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Nextexhibition]].
 *
 * @see Nextexhibition
 */
class NextexhibitionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Nextexhibition[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Nextexhibition|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
