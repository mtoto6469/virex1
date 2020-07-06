<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 9/16/2018
 * Time: 1:30 PM
 */

namespace frontend\models;


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
   public $moveFile4;

    public function rules()
    {
        return[
            [['moveFile1'],'file','extensions'=>'avi,gif,mp4,','maxSize'=>10240000,'tooBig' => 'Limit is 10MB'],
            [['moveFile2'],'file','extensions'=>'avi,gif,mp4,','maxSize'=>10240000,'tooBig' => 'Limit is 10MB'],
            [['moveFile3'],'file','extensions'=>'avi,gif,mp4,','maxSize'=>10240000,'tooBig' => 'Limit is 10MB'],
            [['moveFile4'],'file','extensions'=>'avi,gif,mp4,','maxSize'=>10240000,'tooBig' => 'Limit is 10MB']
            ];
    }
}