<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "advertise".
 *
 * @property int $id
 * @property int $volume
 * @property string $description
 * @property int $price
 * @property int $enable
 */
class Advertise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'advertise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['volume', 'price', 'enable'], 'integer'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'volume' => 'Volume',
            'description' => 'Description',
            'price' => 'Price',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AdvertiseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdvertiseQuery(get_called_class());
    }
}
