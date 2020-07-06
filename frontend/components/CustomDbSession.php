<?php

/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 9/29/2018
 * Time: 4:28 PM
 */
namespace frontend\components;


use Yii;
use yii\db\Connection;
use yii\db\Query;
use yii\base\InvalidConfigException;
use yii\di\Instance;

class CustomDbSession extends \yii\web\DbSession {

    public $writeCallback = ['\frontend\components\CustomDbSession', 'writeCustomFields'];

    public function writeCustomFields($session) {

//        try
//        {
//            $uid = (\Yii::$app->user->getIdentity(false) == -1)?null:\Yii::$app->user->getIdentity(false)->id;
//            return [ 'id_user' => $uid, 'ip' => $_SERVER['REMOTE_ADDR'] ];
//        }
//        catch(\Exception $excp)
//        {
//            \Yii::info(print_r($excp), 'informazioni');
//
//
//        }
    }


}