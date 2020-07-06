<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property int $id_parent
 * @property string $id_img
 * @property int $id_participant
 * @property int $description
 * @property int $enable
 */
class Category extends \yii\db\ActiveRecord
{
    public  $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string'],

//            [['imageFile'],'file','extensions'=>'png,jpg,jpeg,gif,pdf,mp4'],
            [['id_parent', 'id_participant','id_img', 'enable'], 'integer'],
            [['description'], 'string', 'max' => 500],
            ['file','file']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'کد دسته',
            'title' => 'عنوان دسته',
            'id_parent' => 'والد دسته',
            'id_img' => 'عکس',
            'id_participant' => 'کد غرفه دار',
            'description' => 'توضیحات',
            'enable' => 'enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
