<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "participant".
 *
 * @property int $id
 * @property int $id_country
 * @property int $id_exhibitionn
 * @property int $id_room
 * @property int $id_company
 * @property int $id_activity
 * @property int $teaser
 * @property string $responsible_name
 * @property string $semat
 * @property string $email
 * @property string $fax
 * @property string $site_address
 * @property string $telegram
 * @property string $instagram
 * @property string $shortdescription
 * @property string $dsescription
 * @property string $id_images
 * @property int $buy
 * @property int $enable
 */
class Participant extends \yii\db\ActiveRecord
{
    public $file;
    public $file1;
    public $file2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'participant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_country', 'responsible_name', 'semat', 'fax', 'shortdescription', 'dsescription'], 'required'],
            [['id_country', 'id_exhibitionn', 'id_room', 'id_company',  'teaser', 'buy', 'id_images','enable'], 'integer'],
            [['responsible_name', 'semat', 'fax', 'shortdescription', 'id_activity','dsescription'], 'string'],
            [['email'], 'string', 'max' => 250],
            [['site_address', 'telegram', 'instagram'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_country' => 'کد کشور',
            'id_exhibitionn' => 'کد نمایشگاه',
            'id_room' => 'کد غرفه',
            'id_company' => 'کد کاربر',
            'id_activity' => 'نوع فعالیت',
            'teaser' => 'تیزر تبلیغاتی',
            'responsible_name' => 'Responsible Name',
            'semat' => 'سمت مسئول غرفه',
            'email' => 'ایمیل',
            'fax' => 'فکس',
            'site_address' => 'آدرس سایت',
            'telegram' => 'آدرس تلگرام',
            'instagram' => 'ادرس اینستاگرام',
            'shortdescription' => 'توضیحات کوتاه',
            'dsescription' => 'توضیحات',
            'id_images' => 'فایل ها',
            'buy' => 'خرید',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ParticipantQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ParticipantQuery(get_called_class());
    }
}
