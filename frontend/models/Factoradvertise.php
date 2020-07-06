<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "factoradvertise".
 *
 * @property int $id
 * @property int $volume
 * @property int $advertise
 * @property int $id_user
 * @property int $id_participant
 * @property int $price
 * @property string $atu
 * @property string $ref
 * @property int $visible
 * @property int $print
 * @property string $date
 * @property string $date_ir
 * @property string $time
 * @property int $confirm
 * @property int $endPrice
 * @property string $addressOfCentralOffice
 * @property string $factoryAddress
 * @property int $enable
 */
class Factoradvertise extends \yii\db\ActiveRecord
{
    public $file;
    public $file1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'factoradvertise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['volume', 'advertise','id_user', 'id_participant', 'price', 'visible', 'print', 'confirm', 'endPrice', 'enable'], 'integer'],
//            [['date'], 'required'],
            [['date', 'time'], 'safe'],
            [['atu', 'ref', 'addressOfCentralOffice', 'factoryAddress'], 'string', 'max' => 255],
            [['date_ir'], 'string', 'max' => 11],

//            [['file1'],'file','extensions'=>'png,jpg,jpeg,gif,pdf,mp4','maxSize'=>1024000,'tooBig' => 'Limit is 1MB'],
//            [['file2'],'file','extensions'=>'png,jpg,jpeg,gif,pdf,mp4','maxSize'=>11200000,'tooBig' => 'Limit is 50MB']
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
            'advertise' => 'Advertise',
            'id_user' => 'کد کاربری',
            'id_participant' => 'کد غرفه دار',
            'price' => 'Price',
            'atu' => 'Atu',
            'ref' => 'Ref',
            'visible' => 'Visible',
            'print' => 'Print',
            'date' => 'Date',
            'date_ir' => 'Date Ir',
            'time' => 'Time',
            'confirm' => 'Confirm',
            'endPrice' => 'End Price',
            'addressOfCentralOffice' => 'Address Of Central Office',
            'factoryAddress' => 'Factory Address',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FactoradvertiseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FactoradvertiseQuery(get_called_class());
    }
}
