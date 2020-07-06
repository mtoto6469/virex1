<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "myrules".
 *
 * @property int $id
 * @property string $address
 * @property string $phone1
 * @property string $phone2
 * @property string $fax
 * @property string $mobile1
 * @property string $mobile2
 * @property string $guide1
 * @property string $guide2
 * @property string $rules
 * @property string $exhibitTariffs
 * @property string $abouteUs
 * @property int $enable
 */
class Myrules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'myrules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['guide1', 'guide2', 'rules', 'exhibitTariffs', 'abouteUs'], 'required'],
            [['guide1', 'guide2', 'rules', 'exhibitTariffs', 'abouteUs'], 'string'],
            [['enable'], 'integer'],
            [['address'], 'string', 'max' => 500],
            [['phone1', 'phone2', 'fax', 'mobile1', 'mobile2'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'آدرس',
            'phone1' => 'تلفن1',
            'phone2' => 'تلفن2',
            'fax' => 'فکس',
            'mobile1' => 'موبایل1',
            'mobile2' => 'موبایل2',
            'guide1' => 'راهنمای غرفه دار',
            'guide2' => 'راهنمای کاربر',
            'rules' => 'قوانین و مقررات',
            'exhibitTariffs' => 'تعرفه های نمایشگاه',
            'abouteUs' => 'درباره ما',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MyrulesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MyrulesQuery(get_called_class());
    }
}
