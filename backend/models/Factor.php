<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "factor".
 *
 * @property int $id
 * @property int $id_exhibition
 * @property int $id_room
 * @property int $id_company
 * @property int $id_user
 * @property int $price
 * @property string $date
 * @property string $date_ir
 * @property string $time
 * @property string $time_ir
 * @property string $atu
 * @property string $ref
 * @property int $visible
 * @property int $print
 * @property int $enable
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
            [['id_exhibition', 'id_room', 'id_company', 'id_user', 'price', 'visible', 'print', 'enable'], 'integer'],
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
            'price' => 'Price',
            'date' => 'Date',
            'date_ir' => 'Date Ir',
            'time' => 'Time',
            'time_ir' => 'Time Ir',
            'atu' => 'Atu',
            'ref' => 'Ref',
            'visible' => 'Visible',
            'print' => 'Print',
            'enable' => 'Enable',
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
