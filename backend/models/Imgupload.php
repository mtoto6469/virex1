<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 8/1/2018
 * Time: 11:25 AM
 */

namespace backend\models;


use yii\base\Model;
use yii\web\UploadedFile;

class Imgupload extends Model
{
    /**0
     * @var UploadedFile
     */
   public $imageFile;
   public $imageFile1;
   public $imageFile2;

    public function rules()
    {
      return[
          [['imageFile'],'file','extensions'=>'png,jpg,jpeg,gif,pdf,mp4','maxSize'=>1024000,'tooBig' => 'Limit is 950KB'],
          [['imageFile1'],'file','extensions'=>'png,jpg,jpeg,gif,pdf,mp4','maxSize'=>1024000,'tooBig' => 'Limit is 900kB'],
          [['imageFile2'],'file','extensions'=>'png,jpg,jpeg,gif,pdf,mp4','maxSize'=>10240000,'tooBig' => 'Limit is 10MB']
      ];
    }
}