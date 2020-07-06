<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $country_name
 * @property string $id_img
 * @property int $enable
 */
class Country extends \yii\db\ActiveRecord
{
    public $file;
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
            [['country_name'],'required'],
            [['country_name'], 'unique', 'targetClass' => 'backend\models\Country', 'message' => ' این کشور در حال حاضر ثبت شده است '],
            [['enable','id_img'], 'integer'],
            [['country_name'], 'string',
                'min'=>3,
                'max' => 100,
//                'tooShort' => Yii::t("BasicModule.global", "Should contain at least {min, number} {min, plural, one{character} other{characters}}."),
//                'tooLong'  => Yii::t("BasicModule.global", "Should contain at least {max, number} {max, plural, one{character} other{characters}}.")
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'کد کشور',
            'country_name' => 'نام کشور',
            'id_img'=>'عکس',
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
