<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "backgrond".
 *
 * @property int $id
 * @property int $backgrondImg
 * @property string $alt
 */
class Backgrond extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'backgrond';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['backgrondImg'], 'integer'],
            [['alt'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'backgrondImg' => 'Backgrond Img',
            'alt' => 'Alt',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BackgrondQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BackgrondQuery(get_called_class());
    }
}
