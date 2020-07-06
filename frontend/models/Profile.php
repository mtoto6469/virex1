<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $role
 * @property string $name
 * @property string $username
 * @property int $id_user
 * @property string $email
 * @property string $password
 * @property string $telephone
 * @property string $mobile
 * @property string $company_name_en
 * @property string $company_name_ir
 * @property string $date
 * @property string $date_ir
 * @property string $date_update
 * @property string $date_update_ir
 * @property int $state
 * @property int $id_img
 * @property int $rules
 * @property string $code
 * @property string $first
 * @property int $enable
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['username'], 'required'],
            [['id_user', 'state', 'id_img', 'rules', 'enable', 'first'], 'integer'],
            [['date', 'date_update'], 'safe'],
            [['role'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 70],
            [['email'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 30],
            [['telephone', 'mobile'], 'string', 'max' => 11],
            [['company_name_en', 'company_name_ir'], 'string', 'max' => 250],
            [['date_ir', 'date_update_ir'], 'string', 'max' => 10],
            [['code'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'کد کاربر',
            'role' => 'نقش کاربر',
            'name' => 'نام',
            'username' => 'نام کاربری',
            'id_user' => 'Id User',
            'email' => 'ایمیل',
            'password' => 'رمز ورود',
            'telephone' => 'تلفن',
            'mobile' => 'موبایل',
            'company_name_en' => 'نام شرکت (انگلیسی)',
            'company_name_ir' => 'نام شرکت(فارسی)',
            'date' => 'تاریخ',
            'date_ir' => 'تاریخ فارسی',
            'date_update' => 'تاریخ ویرایش',
            'date_update_ir' => 'تاریخ ویرایش فارسی',
            'state' => 'وضعیت کاربر',
            'id_img' => 'عکس کاربر',
            'rules' => 'قوانین',
            'code' => 'کدفعالسازی ایمیل',
            'first' => ' کد فعالسازی اولین تبلیغ',
            'enable' => 'حدف',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }
}
