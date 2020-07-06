<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "friends".
 *
 * @property int $id
 * @property int $id_user
 * @property string $friends_email
 * @property string $yourCode
 * @property int $enable
 */
class Friends extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'friends';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'enable'], 'integer'],
            [['friends_email', 'yourCode'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'کد کاربری',
            'friends_email' => 'ایمیل دوستان',
            'yourCode' => 'Your Code',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FriendsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FriendsQuery(get_called_class());
    }
}
