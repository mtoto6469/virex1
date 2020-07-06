<?php

namespace frontend\models;

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
    public $file1;
    public $file2;
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

            [['file1'],'file','extensions'=>'png,jpg,jpeg,gif,pdf,mp4','maxSize'=>1024 * 1024 * 10,'tooBig' => 'Limit is 1MB'],
            [['file2'],'file','extensions'=>'png,jpg,jpeg,gif,pdf,mp4','maxSize'=>1024 * 1024 * 10,'tooBig' => 'Limit is 50MB']
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
