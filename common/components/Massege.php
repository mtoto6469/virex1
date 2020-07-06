<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 8/6/2018
 * Time: 12:17 PM
 */

namespace common\components;


class Massege
{
    public static function subjectVerifyAccount() {
        return 'فعالسازی حساب کاربری سایت mysite.com';
    }

    public static function verifyAccount($name,$user,$code) {
        return '<p style="direction: rtl;">'.$name.' عزیز از انتخاب سایت ما تشکر می نماییم. </p><br><p style="direction: rtl;">لطفا برای فعالسازی اکانت کاربری خود برروی لینک زیر کلیک و یا آن را در آدرس بار مرورگر خود کپی و بارگذاری کنید.</p><br>
        <a href="'.Yii::app()->homeUrl.'index.php?r=site/verifyaccount&user='.$user.'&code='.$code.'">'.Yii::app()->homeUrl.'index.php?r=site/verifyaccount&user='.$user.'&code='.$code.'</a>';
    }
}