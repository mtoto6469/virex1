<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "productmove".
 *
 * @property int $id
 * @property int $id_product
 * @property int $alt
 * @property string $move1
 * @property string $move2
 * @property string $move3
 * @property string $move4
 * @property int $enable
 */
class Productmove extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productmove';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_product'], 'required'],
            [['id_product', 'enable'], 'integer'],
            [['move1', 'move2', 'move3', 'move4','alt'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Product',
            'alt' => 'Alt',
            'move1' => 'Move1',
            'move2' => 'Move2',
            'move3' => 'Move3',
            'move4' => 'Move4',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductmoveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductmoveQuery(get_called_class());
    }
}
