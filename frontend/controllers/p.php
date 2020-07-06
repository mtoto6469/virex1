<?php



namespace frontend\controllers;





use common\models\LoginForm;
use common\models\User;
use frontend\models\Tblbag;
use frontend\models\Tblfactor;
use frontend\models\Tblnobat;
use Yii;



class PaymentpController extends \yii\web\Controller

{

    // این اکشن برای پرداخت میفرسته اطلاعات را به زرین پال

    public function actionIndex($id)

    {

        $sesssion = yii::$app->session;

        if (!$sesssion->isActive) {

            $sesssion->open();

        }


        if($id==null){
            $_SESSION['error-factor'] = 'در ذخیره اطلاعات مشکلی پیش امده است';

            return $this->redirect(['site/cart']);
        }
        $nobat=Tblnobat::findOne($id);
        if($nobat==null){
            $_SESSION['error-factor'] = 'در ذخیره اطلاعات مشکلی پیش امده است';

            return $this->redirect(['site/cart']);
        }

//        در این قسمت چک میشود که ایدی نوبتی که برای این اکشن فرستاده شده موجود باشد و برای کاربری که الان لاگین است باشد

        $bag =Tblbag::find()->where(['id_nobat'=>$id])->andWhere(['id_bimar'=>Yii::$app->user->getId()])->all();

        if ($bag == null) {

            $_SESSION['error-factor'] = 'در ذخیره اطلاعات مشکلی پیش امده است';

            return $this->redirect(['site/cart']);



        } else {

//            چک میشود که ایا فاکتوری برای این نوبت انجام شده یا نه
            $checkfac=Tblfactor::findOne(['id_nobat'=>$id]);
//            $checkfac=Tblnobat::findOne('id_nobat'=>$id]);
            if($nobat->id_bimar==-1){



                $MerchantID = '93f72728-9f87-11e8-ab64-005056a205be'; //Required

                $Amount = 6000; //Amount will be based on Toman - Required

                $Description = 'توضیحات تراکنش تستی'; // Required

                $Email = 'UserEmail@Mail.Com'; // Optional

                $Mobile = '09123456789'; // Optional

                $CallbackURL = 'http://www.nog-et.com/paymentp/order'; // Required





                $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);



                $result = $client->PaymentRequest(

                    [

                        'MerchantID' => $MerchantID,

                        'Amount' => $Amount,

                        'Description' => $Description,

                        'Email' => $Email,

                        'Mobile' => $Mobile,

                        'CallbackURL' => $CallbackURL,

                    ]

                );



//Redirect to URL You can do it also by creating a form

                if ($result->Status == 100) {

                    $factor=new Tblfactor();
                    $factor->id_user=Yii::$app->user->getId();
                    $factor->mojodi.=''. 6000;
                    $factor->varizi='' . 6000;
                    $factor->id_nobat=$id;
                    $factor->description=' به صورت آنلاین بابت پیش پرداخت';
                    $factor->time=time();
                    $factor->timestamp=date("Y-m-d");
                    $factor->au = $result->Authority;

                    if ($factor->save()) {





                        //این داده ای مهمهی است Authority را باید تو جدول فاکتوری که میفرستی برای پرداخت باید ذخیره کنی تا در زمان برگشت بفهمی کدوم فاکتور را فرستادی

                        Header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
                        exit;

//برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:

//Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');



                    } else {

                        $_SESSION['error-factor'] = 'در پرداخت مشکلی پیش آمده است';

                        return $this->redirect(['site/cart']);

                    }



                } else {

                    $_SESSION['error-factor']= $result->Status;

                    return $this->redirect(['site/cart']);

                }
            }else{
                $_SESSION['error-factor']= 'این نوبت برای شخص دیگری ذخیره شده است';

                return $this->redirect(['site/cart']);
            }


        }

    }





// اینم که برگشته از زرین پال است

    public function actionOrder()

    {

        $sesssion = yii::$app->session;

        if (!$sesssion->isActive) {

            $sesssion->open();

        }
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();



//        مرچنت کد مربوط به نوبت دهی ست شد
        $MerchantID = '93f72728-9f87-11e8-ab64-005056a205be'; //Required

        $Amount =6000; //Amount will be based on Toman

        $Authority = $_GET['Authority'];
        try {
            $check_atu =Tblfactor::find()->where(['au' => $Authority])->count();

            if ($check_atu ==1) {
                $factor =Tblfactor::find()->where(['au' => $Authority])->one();

                if ($factor != null) {
                    if(Yii::$app->user->isGuest){
                        $user=User::findOne($factor->id_user);
                        if($user==null){
                            $factor->delete();
                            $_SESSION['result'] = 'اطلاعات ارسالی درست نمی باشد';
                            return $this->redirect(['site/cart']);
                        }
                        $model=new LoginForm();
                        $model->username=$user->username;
                        $model->password=$user->password_hash;
                        $model->login2();

                    }




                    if ($_GET['Status'] == 'OK') {




                        $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);


                        $result = $client->PaymentVerification(

                            [

                                'MerchantID' => $MerchantID,

                                'Authority' => $Authority,

                                'Amount' => $Amount,

                            ]

                        );



                        if ($result->Status == 100) {




                            $_SESSION['resulttrue'] = 'شماره پیگیری شما:' . $result->RefID;

                            $factor->ref =''. $result->RefID;


                            if($factor->save()){
                                $nobat=Tblnobat::findOne($factor->id_nobat);
                                $nobat->id_bimar=$factor->id_user;
                                $nobat->save();
                                $bag=Tblbag::find()->where(['id_nobat'=>$nobat->id])->all();
                                if($bag!=null){
                                    foreach ($bag as $b){
                                        $b->delete();
                                    }

                                }
                                $transaction->commit();
                                return $this->redirect(['site/cart']);
                            }else{

                                $factor->delete();
                                $_SESSION['result'] = 'عملیات انجام نشد';

                                return $this->redirect(['site/cart']);
                            }

                        } else {


                            $factor->delete();
                            $_SESSION['result'] = 'عملیات موفق آمیز نبود. :' . $result->Status;

                            return $this->redirect(['site/cart']);

                        }

                    } else {
                        $factor->delete();
                        $_SESSION['result'] = 'عملیات توسط کاربر لغو شد';

                        return $this->redirect(['site/cart']);

                    }

                } else {


                    $_SESSION['result'] = 'اطلاعات ارسالی درست نمی باشد';
                    return $this->redirect(['site/cart']);

                }


            } else {

                $_SESSION['result'] = 'عملیات توسط کاربر لغو شد';
                return $this->redirect(['site/cart']);
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            $factor =Tblfactor::find()->where(['au' => $Authority])->one();
            if($factor!=null){
                $factor->delete();
            }
            throw $e;


        } catch (\Throwable $e) {
            $transaction->rollBack();
            $factor =Tblfactor::find()->where(['au' => $Authority])->one();
            if($factor!=null){
                $factor->delete();
            }
            throw $e;
        }

//        $_SESSION['result'] = 'عملیات توسط کاربر لغو شد';
        return $this->redirect(['site/cart']);



    }



}
/**********************payment**************************/
//<?php
//
//
//
//namespace frontend\controllers;
//
//
//use common\models\LoginForm;
//use common\models\User;
////use frontend\models\Tblbag;
//use frontend\models\Factor;
//use frontend\models\Participant;
//use frontend\models\Profile;
//use Yii;
//
//
//
//class PaymentpController extends \yii\web\Controller
//
//{
//
//    // این اکشن برای پرداخت میفرسته اطلاعات را به زرین پال
//
//    public function actionIndex($id)
//
//    {
//
//        $sesssion = yii::$app->session;
//
//        if (!$sesssion->isActive) {
//
//            $sesssion->open();
//
//        }
//
//
//        if ($id == null) {
//            $_SESSION['error-factor'] = 'در ذخیره اطلاعات مشکلی پیش امده است';
//
//            return $this->redirect(['participant/create']);
//        }
////        $factor=Factor::findOne($id);
////        if($factor==null){
////            $_SESSION['error-factor'] = 'در ذخیره اطلاعات مشکلی پیش امده است';
////
////            return $this->redirect(['site/cart']);
////        }
//
////check if there is this factor
//        $factorX = Factor::findOne($id);
//        $profile = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $factorX->id_user])->andWhere(['id' => $factorX->id_company])->one();
//
//        if ($factorX == null) {
//
//            $_SESSION['error-factor'] = 'در ذخیره اطلاعات مشکلی پیش امده است';
//
//            return $this->redirect(['participant/create']);
//
//
//        } else {
//
//            //check for user
//            if (!Yii::$app->user->isGuest) {
//
//                $idUser = Yii::$app->user->getId();
//                $checkUser = Factor::findOne($id);
//
//                if ($idUser == $checkUser->id_user) {
//
//                    $checkU = 1;
//                }//end if user
//                else {
//
//                    $checkU = 0;
//                }//end else user
//
//            }//end if !isGuest
//            else {
//                echo 'لطفا اول ثبت نام کنید';
//                exit;
//            }//end else isGuest
//
//            //$checkU
//            if ($checkU == 1) {
//
//                if ($factorX->ref == '-1') {
//
//
//                    $MerchantID = '851ce5c4-c1bc-11e8-86da-000c295eb8fc'; //Required
//
//                    $Amount = $factorX->price; //Amount will be based on Toman - Required
//
//                    $Description = 'توضیحات تراکنش تستی'; // Required
//
//                    $Email = $profile->email; // Optional
//
//                    $Mobile = $profile->mobile; // Optional
//
//                    $CallbackURL = 'http://vireex.com/paymentp/order'; // Required
//
//
//                    $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
//
//
//                    $result = $client->PaymentRequest(
//
//                        [
//
//                            'MerchantID' => $MerchantID,
//
//                            'Amount' => $Amount,
//
//                            'Description' => $Description,
//
//                            'Email' => $Email,
//
//                            'Mobile' => $Mobile,
//
//                            'CallbackURL' => $CallbackURL,
//
//                        ]
//
//                    );
//
//
////Redirect to URL You can do it also by creating a form
//
//                    if ($result->Status == 100) {
//
//                        $factorX->atu = $result->Authority;
//
//                        if ($factorX->save()) {
//
//
//                            //این داده مهمی است. Authority را باید تو جدول فاکتوری که میفرستی برای پرداخت باید ذخیره کنی تا در زمان برگشت بفهمی کدوم فاکتور را فرستادی
//
//                            Header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
//
////برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:
//
////Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');
//
//
//                        } else {
//
//                            $_SESSION['error-factor'] = 'در پرداخت مشکلی پیش آمده است';
//
//                            return $this->redirect(['participant/create']);
//
//                        }
//
//
//                    } else {
//
//                        echo 'ERR: ' . $result->Status;
//
//                    }
//                }//end if $factor->ref
//                else {
//
//                    $_SESSION['error-factor'] = 'این فاکتور قبلا پرداخت شده است';
//                    return $this->redirect(['participant/create']);
//                }
//
//            }//end id $checkU
//            else {
//                $factorX->delete();
//                echo 2;exit;
//                $_SESSION['error-factor'] = 'در پرداخت مشکلی به وجود آمده است';
//                return $this->redirect(['participant/view','id'=>$factorX->id_company]);
//            }//end else $checkU
//
//
//        }//end else factorX
//
//
//    }
//
//
//
////
////
////
////
////
////////            چک میشود که ایا فاکتوری برای این نوبت انجام شده یا نه
//////            $checkfac=Tblfactor::findOne(['id_nobat'=>$id]);
////////            $checkfac=Tblnobat::findOne('id_nobat'=>$id]);
////            if($nobat->id_bimar==-1){
////
////
////
////                $MerchantID = '93f72728-9f87-11e8-ab64-005056a205be'; //Required
////
////                $Amount = 6000; //Amount will be based on Toman - Required
////
////                $Description = 'توضیحات تراکنش تستی'; // Required
////
////                $Email = 'UserEmail@Mail.Com'; // Optional
////
////                $Mobile = '09123456789'; // Optional
////
////                $CallbackURL = 'http://www.nog-et.com/paymentp/order'; // Required
////
////
////
////
////
////                $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
////
////
////
////                $result = $client->PaymentRequest(
////
////                    [
////
////                        'MerchantID' => $MerchantID,
////
////                        'Amount' => $Amount,
////
////                        'Description' => $Description,
////
////                        'Email' => $Email,
////
////                        'Mobile' => $Mobile,
////
////                        'CallbackURL' => $CallbackURL,
////
////                    ]
////
////                );
////
////
////
//////Redirect to URL You can do it also by creating a form
////
////                if ($result->Status == 100) {
////
////                    $factor=new Tblfactor();
////                    $factor->id_user=Yii::$app->user->getId();
////                    $factor->mojodi.=''. 6000;
////                    $factor->varizi='' . 6000;
////                    $factor->id_nobat=$id;
////                    $factor->description=' به صورت آنلاین بابت پیش پرداخت';
////                    $factor->time=time();
////                    $factor->timestamp=date("Y-m-d");
////                    $factor->au = $result->Authority;
////
////                    if ($factor->save()) {
////
////
////
////
////
////                        //این داده ای مهمهی است Authority را باید تو جدول فاکتوری که میفرستی برای پرداخت باید ذخیره کنی تا در زمان برگشت بفهمی کدوم فاکتور را فرستادی
////
////                        Header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
////                        exit;
////
//////برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:
////
//////Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');
////
////
////
////                    } else {
////
////                        $_SESSION['error-factor'] = 'در پرداخت مشکلی پیش آمده است';
////
////                        return $this->redirect(['site/cart']);
////
////                    }
////
////
////
////                } else {
////
////                    $_SESSION['error-factor']= $result->Status;
////
////                    return $this->redirect(['site/cart']);
////
////                }
////            }else{
////                $_SESSION['error-factor']= 'این نوبت برای شخص دیگری ذخیره شده است';
////
////                return $this->redirect(['site/cart']);
////            }
////
////
////        }
////
////    }
////
//
//
//
//
//// اینم که برگشته از زرین پال است
//
//    public function actionOrder()
//
//    {
//
//        $sesssion = yii::$app->session;
//
//        if (!$sesssion->isActive) {
//
//            $sesssion->open();
//
//        }
//        $connection = \Yii::$app->db;
//        $transaction = $connection->beginTransaction();
//
//
//
//
////        مرچنت کد مربوط به نمایشگاه ست شد
//        $MerchantID = '851ce5c4-c1bc-11e8-86da-000c295eb8fc'; //Required
//
//        $Amount =100; //Amount will be based on Toman
//
//        $Authority = $_GET['Authority'];
//        try {
//            $check_atu =Factor::find()->where(['atu' => $Authority])->count();
//
//            if ($check_atu ==1) {
//                $factor =Factor::find()->where(['atu' => $Authority])->one();
//
//                if ($factor != null) {
//                    if(Yii::$app->user->isGuest){
//                        $user=User::findOne($factor->id_user);
//                        if($user==null){
//                            $factor->delete();
//                            $_SESSION['result'] = 'اطلاعات ارسالی درست نمی باشد';
//                            return $this->redirect(['participant/view']);
//                        }
//                        $model=new LoginForm();
//                        $model->username=$user->username;
//                        $model->password=$user->password_hash;
//                        $model->login();
//
//                    }
//
//
//
//
//                    if ($_GET['Status'] == 'OK') {
//
//
//
//
//                        $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
//
//
//                        $result = $client->PaymentVerification(
//
//                            [
//
//                                'MerchantID' => $MerchantID,
//
//                                'Authority' => $Authority,
//
//                                'Amount' => $Amount,
//
//                            ]
//
//                        );
//
//
//
//                        if ($result->Status == 100) {
//
//
//
//
//                            $_SESSION['resulttrue'] = 'شماره پیگیری شما:' . $result->RefID;
//
//                            $factor->ref = $result->RefID;
//
//
//                            if($factor->save()){
//                                $profile=Participant::findOne($factor->id_company);
//                                $profile->buy=1;
////                                $nobat->id_bimar=$factor->id_user;
//                                $profile->save();
////                                $bag=Tblbag::find()->where(['id_nobat'=>$nobat->id])->all();
////                                if($bag!=null){
////                                    foreach ($bag as $b){
////                                        $b->delete();
////                                    }
////
////                                }
//                                $transaction->commit();
//                                return $this->redirect(['site/cart']);
//                            }else{
//
//                                $factor->delete();
//                                $_SESSION['result'] = 'عملیات انجام نشد';
//
//                                return $this->redirect(['site/cart']);
//                            }
//
//                        } else {
//
//
//                            $factor->delete();
//                            $_SESSION['result'] = 'عملیات موفق آمیز نبود. :' . $result->Status;
//
//                            return $this->redirect(['site/cart']);
//
//                        }
//
//                    } else {
//                        $factor->delete();
//                        $_SESSION['result'] = 'عملیات توسط کاربر لغو شد';
//
//                        return $this->redirect(['site/cart']);
//
//                    }
//
//                } else {
//
//
//                    $_SESSION['result'] = 'اطلاعات ارسالی درست نمی باشد';
//                    return $this->redirect(['site/cart']);
//
//                }
//
//
//            } else {
//
//                $_SESSION['result'] = 'عملیات توسط کاربر لغو شد';
//                return $this->redirect(['site/cart']);
//            }
//
//        } catch (\Exception $e) {
//            $transaction->rollBack();
//            $factor =Factor::find()->where(['atu' => $Authority])->one();
//            if($factor!=null){
//                $factor->delete();
//            }
//            throw $e;
//
//
//        } catch (\Throwable $e) {
//            $transaction->rollBack();
//            $factor =Factor::find()->where(['atu' => $Authority])->one();
//            if($factor!=null){
//                $factor->delete();
//            }
//            throw $e;
//        }
//
////        $_SESSION['result'] = 'عملیات توسط کاربر لغو شد';
//        return $this->redirect(['site/cart']);
//
//
//
//    }
//
//
//
//}