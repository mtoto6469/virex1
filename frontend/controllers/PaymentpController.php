<?php



namespace frontend\controllers;


use common\models\LoginForm;
use common\models\User;
//use frontend\models\Tblbag;
use frontend\models\Factor;
use frontend\models\Participant;
use frontend\models\Profile;
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


        if ($id == null) {
            $_SESSION['error-factor'] = 'در ذخیره اطلاعات مشکلی پیش امده است';

            return $this->redirect(['participant/view','id'=>$id]);
        }
//        $factor=Factor::findOne($id);
//        if($factor==null){
//            $_SESSION['error-factor'] = 'در ذخیره اطلاعات مشکلی پیش امده است';
//
//            return $this->redirect(['site/cart']);
//        }

//check if there is this factor
        $factorX = Factor::findOne($id);
        $profile = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $factorX->id_user])->andWhere(['id' => $factorX->id_company])->one();

        if ($factorX == null) {

            $_SESSION['error-factor'] = 'در ذخیره اطلاعات مشکلی پیش امده است';

            return $this->redirect(['participant/view','id'=>$factorX->id_company]);


        } else {

            //check for user
            if (!Yii::$app->user->isGuest) {

                $idUser = Yii::$app->user->getId();
                $checkUser = Factor::findOne($id);

                if ($idUser == $checkUser->id_user) {

                    $checkU = 1;
                }//end if user
                else {

                    $checkU = 0;
                }//end else user

            }//end if !isGuest
            else {
                echo 'لطفا اول ثبت نام کنید';
                exit;
            }//end else isGuest

            //$checkU
            if ($checkU == 1) {

                if ($factorX->ref == '-1') {


                    $MerchantID = '851ce5c4-c1bc-11e8-86da-000c295eb8fc'; //Required

                    $Amount = $factorX->price; //Amount will be based on Toman - Required

                    $Description = 'توضیحات تراکنش تستی'; // Required

                    $Email = $profile->email; // Optional

                    $Mobile = $profile->mobile; // Optional

                    $CallbackURL = 'http://vireex.com/paymentp/order'; // Required


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

                        $factorX->atu = $result->Authority;

                        if ($factorX->save()) {


                            //این داده مهمی است. Authority را باید تو جدول فاکتوری که میفرستی برای پرداخت باید ذخیره کنی تا در زمان برگشت بفهمی کدوم فاکتور را فرستادی

                            Header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);

//برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:

//Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');


                        } else {
                            
                            $factorX->delete();
                            $_SESSION['error-factor'] = 'در پرداخت مشکلی پیش آمده است';

                            return $this->redirect(['participant/view','id'=>$factorX->id_company]);

                        }


                    } else {

                        echo 'ERR: ' . $result->Status;

                    }
                }//end if $factor->ref
                else {
                    
                    $_SESSION['error-factor'] = 'این فاکتور قبلا پرداخت شده است';
                    return $this->redirect(['participant/view','id'=>$factorX->id_company]);
                }

            }//end id $checkU
            else {
$factorX->delete();
                
                $_SESSION['error-factor'] = 'در پرداخت مشکلی به وجود آمده است';
                return $this->redirect(['participant/view','id'=>$factorX->id_company]);
            }//end else $checkU


        }//end else factorX


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




//        مرچنت کد مربوط به نمایشگاه ست شد
            $MerchantID = '851ce5c4-c1bc-11e8-86da-000c295eb8fc'; //Required

            $Amount =100; //Amount will be based on Toman

            $Authority = $_GET['Authority'];
        try {
            $check_atu =Factor::find()->where(['atu' => $Authority])->count();
            $factor =Factor::find()->where(['atu' => $Authority])->one();

            if ($check_atu ==1) {
                $factor =Factor::find()->where(['atu' => $Authority])->one();

                if ($factor != null) {
                    if(Yii::$app->user->isGuest){
                        $user=User::findOne($factor->id_user);
                        if($user==null){
                            $factor->delete();
                            $_SESSION['result'] = 'اطلاعات ارسالی درست نمی باشد';
                            return $this->redirect(['participant/view']);
                        }
                        $model=new LoginForm();
                        $model->username=$user->username;
                        $model->password=$user->password_hash;
                        $model->login();

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

                            $factor->ref = $result->RefID;


                            if($factor->save()){
                                $profile=Participant::findOne($factor->id_company);
                                if ($profile){
                                    if ($profile->buy==1){
                                        $factor->buyAdvertise=1;
                                        $factor->save();
                                    }else{
                                        $profile->buy=1;
                                        $profile->save();
                                    }
                                   
                                }else{
                                    $factor->buyAdvertise=1;
                                    $factor->save();
                                }

//                                $nobat->id_bimar=$factor->id_user;

//                                $bag=Tblbag::find()->where(['id_nobat'=>$nobat->id])->all();
//                                if($bag!=null){
//                                    foreach ($bag as $b){
//                                        $b->delete();
//                                    }
//
//                                }
                                $transaction->commit();
                                return $this->redirect(['participant/view','id'=>$factor->id_company]);
                            }else{

                                $factor->delete();
                                $_SESSION['result'] = 'عملیات انجام نشد';

                                return $this->redirect(['participant/view','id'=>$factor->id_company]);
                            }

                        } else {


                            $factor->delete();
                            $_SESSION['result'] = 'عملیات موفق آمیز نبود. :' . $result->Status;

                            return $this->redirect(['participant/view','id'=>$factor->id_company]);

                        }

                    } else {
                        $factor->delete();
                        $_SESSION['result'] = 'عملیات توسط کاربر لغو شد';

                        return $this->redirect(['participant/view','id'=>$factor->id_company]);

                    }

                } else {

                    $factor->delete();
                    $_SESSION['result'] = 'اطلاعات ارسالی درست نمی باشد';
                    return $this->redirect(['participant/view','id'=>$factor->id_company]);

                }


            } else {

                $factor->delete();
                $_SESSION['result'] = 'عملیات توسط کاربر لغو شد';
                return $this->redirect(['participant/view','id'=>$factor->id_company]);
            }

        } catch (\Exception $e) {
            $transaction->rollBack();
            $factor =Factor::find()->where(['atu' => $Authority])->one();
            if($factor!=null){
                $factor->delete();
            }
            throw $e;


        } catch (\Throwable $e) {
            $transaction->rollBack();
            $factor =Factor::find()->where(['atu' => $Authority])->one();
            if($factor!=null){
                $factor->delete();
            }
            throw $e;
        }

        $_SESSION['result'] = 'عملیات توسط کاربر لغو شد';
        return $this->redirect(['participant/view','id'=>$factor->id_company]);



    }



}