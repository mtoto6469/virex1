<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property int $id_country
 * @property int $id_exhibition
 * @property int $id_activity
 * @property string $id_img
 * @property int $price
 * @property string $description
 * @property int $enable
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_country', 'id_exhibition', 'price'], 'required'],
            [['id_country', 'id_exhibition', 'id_activity', 'price', 'enable'], 'integer'],
            [['id_img', 'description'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_country' => 'Id Country',
            'id_exhibition' => 'Id Exhibition',
            'id_activity' => 'Id Activity',
            'id_img' => 'Id Img',
            'price' => 'Price',
            'description' => 'Description',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoomQuery(get_called_class());
    }
}
