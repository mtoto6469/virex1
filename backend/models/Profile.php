<?php

namespace backend\models;

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
 * @property int $first
 * @property int $enable
 */
class Profile extends \yii\db\ActiveRecord
{
    public $file;
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
            [['id_user', 'state', 'rules', 'enable','first'], 'integer'],
            [['username'], 'required'],
            [['id_img'], 'integer'],
//            [['file'],'file','extensions'=>'png,jpg,jpeg,gif,pdf'],
            [['date', 'date_update'], 'safe'],
            [['role'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 70],
            [['username', 'email'], 'string', 'max' => 100],
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
            'id' => 'ID',
            'role' => 'نقش کاربر',
            'name' => 'نام کاربر',
            'username' => 'نام کاربری کاربر',
            'id_user' => 'کد کاربری کاربر',
            'email' => 'ایمیل کاربر',
            'password' => 'پسورد کاربر',
            'telephone' => 'تلفن کاربر',
            'mobile' => 'موبایل کاربر',
            'company_name_en' => 'نام انگلیسی شرکت کاربر',
            'company_name_ir' => 'نام فارسی شرکت کاربر',
            'date' => 'تاریخ ایجاد',
            'date_ir' => 'تاریخ به شمسی',
            'date_update' => 'تاریخ ویرایش',
            'date_update_ir' => 'تاریخ به شمسی',
            'state' => 'وضعیت کاربر',
            'id_img' => 'کد عکس کاربر',
            'rules' => 'قوانین شرکت',
            'code' => 'کد هش شده ',
            'first'=>'ثبت اولین محصول',
            'enable' => 'Enable',
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
