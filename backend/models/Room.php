<?php

namespace backend\models;

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
    public $file;
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
            [['id_country', 'id_exhibition', 'price','id_img',], 'required'],
//            [['file'],'file','extensions'=>'png,jpg,jpeg,gif,pdf'],
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
            'id' => 'کد غرفه',
            'id_country' => 'کد کشور',
            'id_exhibition' => 'کد نمایشگاه',
            'id_activity' => 'نوع فعالیت',
            'id_img' => 'عکس',
            'price' => 'قیمت غرفه',
            'description' => 'توضیحات',
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
