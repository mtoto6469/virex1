<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[SessionFrontendUser]].
 *
 * @see SessionFrontendUser
 */
class SessionFrontendUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SessionFrontendUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SessionFrontendUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
