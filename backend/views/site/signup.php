<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="site-signup">

    <div class="profile-create col-lg-10">

        <h1> کاربر جدید</h1>


        <div class="profile-form">

            <form id="w0" action="/backend/web/site/signup" method="post" enctype="multipart/form-data">
<!--                <input name="_csrf-backend" value="kLyjt8JZPYObsZIgr_4ibqD9yICDp1Su5SP-Yq4ULD72i5PCpBVL1qzw1EHrlGsr8If5s-HoAJetV5AR-2BUag==" type="hidden">-->
                <div class="form-group field-profile-role">
                    <label class="control-label" for="profile-role">نقش کاربر</label>
                    <select id="profile-role" class="form-control" name="SignupForm[role]" 0="options">
                        <option value="admin">مدیر کل</option>
                        <option value="booth">غرفه دار</option>
                        <option value="writer">منشی</option>
                        <option value="user">کاربر</option>
                    </select>

                    <div class="help-block"></div>
                </div>
                <div class="form-group field-profile-name">
                    <label class="control-label" for="profile-name">نام کاربر</label>
                    <input id="profile-name" class="form-control" name="SignupForm[name]" maxlength="70" type="text">

                    <div class="help-block"></div>
                </div>
                <div class="form-group field-profile-username required">
                    <label class="control-label" for="profile-username">نام کاربری کاربر</label>
                    <input id="profile-username" class="form-control" name="SignupForm[username]" maxlength="100" aria-required="true" type="text">

                    <div class="help-block"></div>
                </div>
                <div class="form-group field-profile-password">
                    <label class="control-label" for="profile-password">پسورد کاربر</label>
                    <input id="profile-password" class="form-control" name="SignupForm[company_name_en]" maxlength="30" type="text" value="void">

                    <div class="help-block"></div>
                </div>
                <div class="form-group field-profile-password">
                    <label class="control-label" for="profile-password">پسورد کاربر</label>
                    <input id="profile-password" class="form-control" name="SignupForm[company_name_ir]" maxlength="30" type="text" value="void">

                    <div class="help-block"></div>
                </div>

                <div class="form-group field-profile-password">
                    <label class="control-label" for="profile-password">پسورد کاربر</label>
                    <input id="profile-password" class="form-control" name="SignupForm[password]" maxlength="30" type="password">

                    <div class="help-block"></div>
                </div>
                <div class="form-group field-profile-telephone">
                    <label class="control-label" for="profile-telephone">تلفن کاربر</label>
                    <input id="profile-telephone" class="form-control" name="SignupForm[telephone]" maxlength="11" type="text">

                    <div class="help-block"></div>
                </div>
                <div class="form-group field-profile-mobile">
                    <label class="control-label" for="profile-mobile">موبایل کاربر</label>
                    <input id="profile-mobile" class="form-control" name="SignupForm[mobile]" maxlength="11" type="text">

                    <div class="help-block"></div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-success">ذخیره</button>    </div>

            </form>
        </div>

    </div>

</div>