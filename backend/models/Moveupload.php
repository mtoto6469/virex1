<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 9/16/2018
 * Time: 1:30 PM
 */

namespace backend\models;


use yii\base\Model;
use yii\web\UploadedFile;

class Moveupload extends Model
{
    /**0
     * @var UploadedFile
     */
// upload move
   public $moveFile1;
   public $moveFile2;
   public $moveFile3;

    public function rules()
    {
        return[
            [['moveFile1'],'file','extensions'=>'avi,gif,mp4,','maxSize'=>1024000,'tooBig' => 'Limit is 10MB','maxFiles'=>20],
            [['moveFile2'],'file','extensions'=>'pdf','maxSize'=>1024000,'tooBig' => 'Limit is 10MB'],
            [['moveFile3'],'file','extensions'=>'avi,gif,mp4,','maxSize'=>1024000,'tooBig' => 'Limit is 10MB']
           
            ];
    }
}