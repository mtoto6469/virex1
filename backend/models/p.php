<?php
//
//namespace backend\models;
//
//use Yii;
//
///**
// * This is the model class for table "exhibitionn".
// *
// * @property int $id
// * @property int $id_country
// * @property string $title
// * @property string $image
// * @property string $holding_date
// * @property string $holding_date_ir
// * @property string $completion_date
// * @property string $completion_date_ir
// * @property string $holding_time
// * @property string $completion_time
// * @property int $enable
// */
//class Exhibitionn extends \yii\db\ActiveRecord
//{
//    public $file;
//    /**
//     * {@inheritdoc}
//     */
//    public static function tableName()
//    {
//        return 'exhibitionn';
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function rules()
//    {
//        return [
//            [['id_country', 'title', 'holding_date', 'completion_date'], 'required'],
//            [['id_country', 'enable'], 'integer'],
////            [['file'],'file','extensions'=>'png,jpg,jpeg,gif,pdf'],
//            [['holding_date', 'completion_date', 'holding_time', 'completion_time'], 'safe'],
//            [['title','image'], 'string', 'max' => 250],
//            [['holding_date_ir', 'completion_date_ir'], 'string', 'max' => 10],
//        ];
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => 'کد نمایشگاه',
//            'id_country' => 'کد کشور',
//            'title' => 'عنوان نمایشگاه',
//            'image' => 'عکس نمایشگاه',
//            'holding_date' => 'تاریخ برگزاری',
//            'holding_date_ir' => 'Holding Date Ir',
//            'completion_date' => 'تاریخ پایان',
//            'completion_date_ir' => 'Completion Date Ir',
//            'holding_time' => 'ساعت شروع',
//            'completion_time' => 'ساعت پایان',
//            'enable' => 'حذف',
//        ];
//    }
//
//    /**
//     * {@inheritdoc}
//     * @return ExhibitionnQuery the active query used by this AR class.
//     */
//    public static function find()
//    {
//        return new ExhibitionnQuery(get_called_class());
//    }
//}
