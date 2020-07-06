<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "img".
 *
 * @property int $id
 * @property string $fileImg
 * @property string $filePdf
 * @property string $fileMove
 * @property string $alt
 * @property int $id_participant
 * @property int $uses
 * @property int $enable
 */
class Img extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_participant', 'enable'], 'integer'],
            [['fileImg','filePdf','fileMove','alt','uses'], 'string', 'max' => 250]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'کد فایل',
            'fileImg' => 'عنوان فایل',
            'filePdf' => 'عنوان فایل',
            'fileMove' => 'عنوان فایل',
            'alt' => 'Alt',
            'id_participant' => 'کد غرفه دار',
            'uses'=>'محل استفاده عکس',
            'enable' => 'حذف',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ImgQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImgQuery(get_called_class());
    }
}
