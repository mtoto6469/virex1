<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Img]].
 *
 * @see Img
 */
class ImgQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Img[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Img|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
