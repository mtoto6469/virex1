<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 8/7/2018
 * Time: 5:43 PM
 */

namespace common\components;


class Massage extends components
{
    public static function subjectVerifyAccount() {
        return 'فعالسازی حساب کاربری سایت mysite.com';
    }

    public static function verifyAccount($name,$user,$verifycode) {
        return '<p style="direction: rtl;">'.$name.' عزیز از انتخاب سایت ما تشکر می نماییم. </p><br><p style="direction: rtl;">لطفا برای فعالسازی اکانت کاربری خود برروی لینک زیر کلیک و یا آن را در آدرس بار مرورگر خود کپی و بارگذاری کنید.</p><br><a href="'.Yii::app()->homeUrl.'index.php?r=site/verifyaccount&user='.$user.'&code='.$verifycode.'">'.Yii::app()->homeUrl.'index.php?r=site/verifyaccount&user='.$user.'&code='.$verifycode.'</a>';
    }
}