<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 8/7/2018
 * Time: 5:37 PM
 */

namespace common\components;
use Yii;

class maill extends components
{
    public static function mailSend($to,$subject, $message) {
        $mail = Yii::app()->Smtpmail;
        $mail->SetFrom('mtoto6469@gmail.com', 'لینک فعالسازی ');
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug=1;
        $mail->AddAddress($to, "");
        return $mail->Send();
        }
}