<?php
//
namespace frontend\models;
//
//use Yii;
//
///**
// * This is the model class for table "product".
// *
// * @property int $id
// * @property string $title
// * @property int $id_participant
// * @property string $typePro
// * @property int $id_img
// * @property int $id_Category
// * @property string $shortDescription
// * @property string $description
// * @property int $enable
// */
///**
// * This is the model class for table "product".
// *
//
// */
//class Product extends \yii\db\ActiveRecord
//{
//    public $fileMove1;
//    public $fileMove2;
//    public $fileMove3;
//    public $fileMove4;
//    /**
//     * {@inheritdoc}
//     */
//    public static function tableName()
//    {
//        return 'product';
//    }
//
//    /**
//     * {@inheritdoc}
//     */
////    public function rules()
////    {
////        return [
////            [['id_participant', 'id_img', 'id_Category', 'enable'], 'integer'],
////            [['title', 'typePro', 'shortDescription'], 'string', 'max' => 250],
////            [['description'], 'string', 'max' => 500],
////        ];
////    }
//    public function rules()
//    {
//        return [
//            [['title', 'description'], 'required'],
//            [['id_participant', 'id_category', 'enable'], 'integer'],
//            [['description', 'id_img'], 'string'],
//            [['title', 'typePro', 'id_img'], 'string', 'max' => 250],
//            [['shortDescription'], 'string', 'max' => 500],
//        ];
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => 'ID',
//            'title' => 'Title',
//            'id_participant' => 'Id Participant',
//            'typePro' => 'Type Pro',
//            'id_img' => 'Id Img',
//            'id_category' => 'Id  Category',
//            'shortDescription' => 'Short Description',
//            'description' => 'Description',
//            'enable' => 'Enable',
//        ];
//    }
//
//    /**
//     * {@inheritdoc}
//     * @return ProductQuery the active query used by this AR class.
//     */
//    public static function find()
//    {
//        return new ProductQuery(get_called_class());
//    }
//}


//namespace backend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property int $id_participant
 * @property string $typePro
 * @property int $id_img
 * @property int $id_Category
 * @property string $shortDescription
 * @property string $description
 * @property int $enable
 */
class Product extends \yii\db\ActiveRecord
{
    public $fileMove1;
    public $fileMove2;
    public $fileMove3;
//    public $fileMove4;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
           
            [['id_participant', 'id_img', 'id_Category', 'enable'], 'integer'],
            [['title', 'typePro', 'shortDescription'], 'string', 'max' => 250],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'نام محصول',
            'id_participant' => 'کد غرفه دار',
            'typePro' => 'توع محصول',
            'id_img' => 'عکس',
            'id_Category' => 'دسته محصول',
            'shortDescription' => 'توضیحات کوتاه',
            'description' => 'توضیحات',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
