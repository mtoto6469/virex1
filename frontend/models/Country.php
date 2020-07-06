<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $country_name
 * @property int $id_img
 * @property int $enable
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_name'], 'required'],
            [['id_img', 'enable'], 'integer'],
            [['country_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_name' => 'Country Name',
            'id_img' => 'Id Img',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountryQuery(get_called_class());
    }
}
