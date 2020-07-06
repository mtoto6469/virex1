<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "factor".
 *
 * @property int $id
 * @property int $id_exhibition
 * @property int $id_room
 * @property int $id_company
 * @property int $id_user
 * @property int $id_participant
 * @property int $volume
 * @property int $id_advertise
 * @property int $price
 * @property string $date
 * @property string $date_ir
 * @property string $time
 * @property string $time_ir
 * @property string $atu
 * @property string $ref
 * @property int $visible
 * @property int $print
 * @property int $endPrice
 * @property int $enable
 * @property int $buyAdvertise
 */
class Factor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'factor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_exhibition', 'id_room', 'id_company', 'id_user', 'id_participant', 'volume', 'id_advertise', 'price', 'visible', 'print', 'endPrice', 'enable', 'buyAdvertise'], 'integer'],
            [['date', 'date_ir', 'time', 'time_ir'], 'required'],
            [['date', 'time'], 'safe'],
            [['date_ir', 'time_ir'], 'string', 'max' => 10],
            [['atu', 'ref'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_exhibition' => 'Id Exhibition',
            'id_room' => 'Id Room',
            'id_company' => 'Id Company',
            'id_user' => 'Id User',
            'id_participant' => 'Id Participant',
            'volume' => 'Volume',
            'id_advertise' => 'Id Advertise',
            'price' => 'Price',
            'date' => 'Date',
            'date_ir' => 'Date Ir',
            'time' => 'Time',
            'time_ir' => 'Time Ir',
            'atu' => 'Atu',
            'ref' => 'Ref',
            'visible' => 'Visible',
            'print' => 'Print',
            'endPrice' => 'End Price',
            'enable' => 'Enable',
            'buyAdvertise' => 'Buy Advertise',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FactorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FactorQuery(get_called_class());
    }
}
