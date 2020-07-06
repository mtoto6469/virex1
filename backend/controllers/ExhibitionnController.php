<?php

namespace backend\controllers;

use backend\models\Activity;
use backend\models\Category;
use backend\models\Country;
use backend\models\Img;
use backend\models\Product;
use backend\models\Profile;
use backend\models\Room;
use common\components\General;
use common\components\jdf;
use common\models\User;
use Faker\Provider\DateTime;
use frontend\models\Participant;
use PHPUnit\Framework\Exception;
use Yii;
use backend\models\Exhibitionn;
use backend\models\ExhibitionnSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ExhibitionnController implements the CRUD actions for Exhibitionn model.
 */
class ExhibitionnController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Exhibitionn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExhibitionnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Exhibitionn model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $exhibit=Exhibitionn::find()->where(['id'=>$id])->one();
        //send sms
        $textSms=$exhibit->title;
        $phoneNumber=null;

        $sms=new General();
        $sendSms=$sms->sendSms($textSms,$phoneNumber);
        if ($sendSms){

//                                $_SESSION['error']='sms';
            echo 5;exit;
        }//end if $sendSms
        else{
//                                echo 5;exit;
//                                $_SESSION['error'] = $['msg'];
        }//end else sendSms

        return $this->render('view', [
            'model' => $this->findModel($id),

        ]);
    }

    /**
     * Creates a new Exhibitionn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //با وجود translate عکس ها در دیتا بیس دخیره نمیشدن
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $user=User::findOne(Yii::$app->user->getId());
            $booth=$user->id;
            $model = new Exhibitionn();
            $images = new Img();
            $county = ArrayHelper::map(Country::find()->where(['enable' => 1])->all(), 'id', 'country_name');
            if ($model->load(Yii::$app->request->post())) {

                $model->file = UploadedFile::getInstance($model, 'file');

                if ($model->file != null) {

                    if ($model->validate()) {

                        $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $model->file->baseName . '.' . $model->file->extension);

                        $images->filePdf="void";
                        $images->fileMove="void";
                        $images->uses = "exhibition";
                        $images->alt = "virtual exhibition";
                        $images->enable = 1;
                        $images->id_participant = $booth;
                        $images->fileImg = $model->file->baseName . '.' . $model->file->extension;
                        if ($images->save()) {

                            $im = $images->id;
                        } else {
                        }

                        //time
                        $model->holding_time='00:00:01';
                        $model->completion_time='24:00:00';

                        $model->image = $im;
                        $model->enable = 1;
                        $date_ir = new jdf();
                        $pattern = $model->completion_date;
                        $pattern;
                        $time = explode("/", $pattern);//نباید یه جای "/" از "-"استفاده شود چون ارور offset 2 رو میده
                        $d = $time[2];
                        $m = $time[1];
                        $y = $time[0];
                        $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
                        $Y = $time2[0];
                        $M = $time2[1];
                        $D = $time2[2];
                        $date = $Y . '/' . $M . '/' . $D;
                        $model->completion_date_ir = $date;


                        $pattern1 = $model->holding_date;
                        $time = explode("/", $pattern1);
                        $d = $time[2];
                        $m = $time[1];
                        $y = $time[0];
                        $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
                        $Y = $time2[0];
                        $M = $time2[1];
                        $D = $time2[2];
                        $date1 = $Y . '/' . $M . '/' . $D;
                        $model->holding_date_ir = $date1;

                        if ($model->save()) {

                            $transaction->commit();

//                            //send sms
//                            $textSms=$model->title;
//                            $phoneNumber=null;
//
//                            $sms=new General();
//                            $sendSms=$sms->sendSms($textSms,$phoneNumber);
//                            if ($sendSms){
//
////                                $_SESSION['error']='sms';
//                                echo 5;exit;
//                            }//end if $sendSms
//                            else{
////                                echo 5;exit;
////                                $_SESSION['error'] = $['msg'];
//                            }//end else sendSms

                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            return $this->render('create', [
                                'model' => $model,
                                'country' => $county,
                                'images' => $images,
                            ]);
                        }


                    }//end validate
                    return $this->render('create', [
                        'model' => $model,
                        'country' => $county,
                        'images' => $images,
                    ]);
                } else {

                    $model->image = -1;
                    $model->enable = 1;
                    $date_ir = new jdf();
                    $pattern = $model->completion_date;
                    ($time = explode("/", $pattern));
                    $d = $time[2];
                    $m = $time[1];
                    $y = $time[0];
                    $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
//                    var_dump($time2 = $date_ir->jalaliToGregorian($d, $m, $y));
                    $Y = $time2[0];
                    $M = $time2[1];
                    $D = $time2[2];
                    $date = $Y . '/' . $M . '/' . $D;
                    $model->completion_date_ir = $date;
                    var_dump($model->completion_date_ir = $date);

                    $pattern1 = $model->holding_date;
                    $time = explode("/", $pattern1);
                    $d = $time[2];
                    $m = $time[1];
                    $y = $time[0];
                    $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
                    $Y = $time2[0];
                    $M = $time2[1];
                    $D = $time2[2];
                    $date1 = $Y . '/' . $M . '/' . $D;
                    $model->holding_date_ir = $date1;

                    if ($model->save()) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        return $this->render('create', [
                            'model' => $model,
                            'country' => $county,
                        ]);
                    }
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'country' => $county,
                    'images' => $images,
                ]);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
//            Yii::$app->user->setFlash('error', "{$e->getMessage()}");
            $this->refresh();
        }
    }

    /**
     * Updates an existing Exhibitionn model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        //با وجود translate عکس ها در دیتا بیس دخیره نمیشدن
//        $transaction=Yii::$app->db->beginTransaction();
        try {

            $model = $this->findModel($id);
            $user=User::findOne(Yii::$app->user->getId());
            $booth=$user->id;
            $country = ArrayHelper::map(Country::find()->where(['enable' => 1])->all(), 'id', 'country_name');

            $exhibition = Exhibitionn::find()->where(['enable' => 1]);
            
//            $img=Img::find()->where(['id'=>$model->image])->andWhere(['enable'=1])->one();
            $images = new Img();

            if ($model->load(Yii::$app->request->post())) {


                $model->file = UploadedFile::getInstance($model, 'file');

                //زمانی که عکس جدید آپلود میکنیم
                if ($model->file != null) {

                    $img=Img::find()->where(['id'=>$model->image])->andWhere(['enable'=>1])->one();
                    if ($img){
                        $fileName=$img->fileImg;

                    if ($model->file != $fileName) {

                        $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $model->file->baseName . '.' . $model->file->extension);

                        $images->filePdf = "void";
                        $images->fileMove = "void";
                        $images->uses = "exhibition";
                        $images->alt = "virtual exhibition";
                        $images->enable = 1;
                        $images->id_participant = $booth;
                        $images->fileImg = $model->file->baseName . '.' . $model->file->extension;

                        if ($images->save()) {
                            $im = $images->id;
                        } else {
                            $_SESSION['error'] = "در ذخیره سازی عکس مشکلی پیش آمده لطفا دوباره تلاش نمایید";
                            return $this->render('create', [
                                'model' => $model,
                                'country' => $country,
                                'images' => $images,
                            ]);
                        }

                        $model->image = $im;
                        $model->enable = 1;
                        $date_ir = new jdf();
                        $pattern = $model->completion_date;
                        $time = explode("/", $pattern);
                        $d = $time[2];
                        $m = $time[1];
                        $y = $time[0];
                        $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
                        $Y = $time2[0];
                        $M = $time2[1];
                        $D = $time2[2];
                        $date = $Y . '/' . $M . '/' . $D;
                        $model->completion_date_ir = $date;

                        $pattern1 = $model->holding_date;
                        $time = explode("/", $pattern1);
                        $d = $time[2];
                        $m = $time[1];
                        $y = $time[0];
                        $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
                        $Y = $time2[0];
                        $M = $time2[1];
                        $D = $time2[2];
                        $date1 = $Y . '/' . $M . '/' . $D;
                        $model->holding_date_ir = $date1;

                        if ($model->save()) {

//                            $transdction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {

                            return $this->render('create', [
                                'model' => $model,
                                'country' => $country,
                                'images' => $images,

                            ]);
                        }
                    }//end if img
                    } //end if $model->file != $im
                    else {

//                        $model->image;
                        $model->enable = 1;
                        $model->completion_date_ir = "";
                        $model->holding_date_ir = "";

                        $date_ir = new jdf();
                        $pattern = $model->completion_date;
                        $time = explode("/", $pattern);
                        $d = $time[2];
                        $m = $time[1];
                        $y = $time[0];
                        $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
                        $Y = $time2[0];
                        $M = $time2[1];
                        $D = $time2[2];
                        $date = $Y . '/' . $M . '/' . $D;
                        $model->completion_date_ir = $date;


                        $pattern1 = $model->holding_date;
                        $time = explode("/", $pattern1);
                        $d = $time[2];
                        $m = $time[1];
                        $y = $time[0];
                        $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
                        $Y = $time2[0];
                        $M = $time2[1];
                        $D = $time2[2];
                        $date1 = $Y . '/' . $M . '/' . $D;
                        $model->holding_date_ir = $date1;

                        if ($model->save()) {
//                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {

                            return $this->render('create', [
                                'model' => $model,
                                'country' => $country,
                                'images' => $images,
                            ]);
                        }
                    }//end else $model->file != $im

                }//end if $model->file != null

                //زمانی که قبلا عکس دخیره بوده و ما الان هیچ عکسی اپلود نکردیم
                elseif ($model->file == null && $model->image != -1) {
//var_dump($model->image);exit;
//                    
                    $model->enable = 1;
                    $date_ir = new jdf();
                    $pattern = $model->completion_date;
                    $time = explode("/", $pattern);
                    $d = $time[2];
                    $m = $time[1];
                    $y = $time[0];
                    $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
                    $Y = $time2[0];
                    $M = $time2[1];
                    $D = $time2[2];
                    $date = $Y . '/' . $M . '/' . $D;
                    $model->completion_date_ir = $date;

                    $pattern1 = $model->holding_date;
                    $time = explode("/", $pattern1);
                    $d = $time[2];
                    $m = $time[1];
                    $y = $time[0];
                    $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
                    $Y = $time2[0];
                    $M = $time2[1];
                    $D = $time2[2];
                    $date1 = $Y . '/' . $M . '/' . $D;
                    $model->holding_date_ir = $date1;


                    if ($model->save()) {

//                    $transdction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {

                        return $this->render('create', [
                            'model' => $model,
                            'country' => $country,
                            'images' => $images,
                           
                        ]);
                    }

                }//end elseif $model->file == null && $model->image != 'void'

                // زمانی که قبلا هیچ عکسی براش ذخیره نکردیم و الان هم عکس آپلود نمیکنیم
                else {

                    $model->image = -1;
                    $model->enable = 1;
                    $date_ir = new jdf();
                    $pattern = $model->completion_date;
                    $time = explode("/", $pattern);
                    $d = $time[2];
                    $m = $time[1];
                    $y = $time[0];
                    $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
                    $Y = $time2[0];
                    $M = $time2[1];
                    $D = $time2[2];
                    $date = $Y . '/' . $M . '/' . $D;
                    $model->completion_date_ir = $date;

                    $pattern1 = $model->holding_date;
                    $time = explode("/", $pattern1);
                    $d = $time[2];
                    $m = $time[1];
                    $y = $time[0];
                    $time2 = $date_ir->jalaliToGregorian($d, $m, $y);
                    $Y = $time2[0];
                    $M = $time2[1];
                    $D = $time2[2];
                    $date1 = $Y . '/' . $M . '/' . $D;
                    $model->holding_date_ir = $date1;

                    if ($model->save()) {
//                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        return $this->render('create', [
                            'model' => $model,
                            'country' => $country,
                            'images' => $images,
                           
                        ]);
                    }
                }//end elseif $model->file != null  پایانی

            }//end $model->load
            else {

                return $this->render('update', [
                    'model' => $model,
                    'country' => $country,
                    'images' => $images,
                    'exhibition' => $exhibition,
                   
                ]);
            }//end else $model->load

        } //end try
        catch (Exception $e) {
//           $transaction->rollBack();
            Yii::$app->user->setFlash('error', "{$e->getMessage()}");
            $this->refresh();
        }//end catch
    }//end function


    /**
     * Deletes an existing Exhibitionn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = $this->findModel($id);
            $participant=\backend\models\Participant::find()->where(['id_country'=>$model->id_country])->andWhere(['id_exhibitionn'=>$model->id])->andWhere(['buy'=>1])->andWhere(['enable'=>1])->all();
            if ($participant){
                $_SESSION['error']='در این نمایشگاه غرفه ای ثبت و پول ان پرداخت شده شما فقط قادر به ویرایش آن هستید';
                return $this->render(['index']);
            }//end if $participant
            else{
                //delete activity
                $activity=Activity::find()->where(['id_country'=>$model->id_country])->andWhere(['id_exhibition'=>$model->id])->andWhere(['enable'=>1])->all();
                foreach ($activity as $act){
                    $act->enable=0;
                    $act->save();
                }//end foreach $activity

                //delete room
                $room=Room::find()->where(['id_country'=>$model->id_country])->andWhere(['$id_exhibition'=>$model->id])->andWhere(['enable'=>1])->all();
                foreach ($room as $r){
                    $r->enable=0;
                    $r->save();
                }//end foreach $room
                
                //delete exhibition
                $model->enable = 0;
                if ($model->save()) {
                    $transaction->commit();
                    return $this->redirect(['index']);
                }else{
//                    var_dump($model->getErrors());exit;
                    return $this->render(['index']);
                }
            }//end else $participant
            
        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
//            Yii::$app->user->setFlash('error', "{$e->getMessage()}");
            $this->refresh();
        }//end catch

    }//end function

    public function actionEndtime($id)
    {
        $exhibition = Exhibitionn::find()->where(['enable' => 1])->all();
//        $e = Exhibitionn::find()->where(['enable' => 1])->andWhere(['id'=>$id])->one();
//        $a=strtotime($e->holding_date_ir);
//        $b=strtotime($e->completion_date_ir);
//        $x=($a - $b)/(60*60*24);//day
//        $x=($a - $b)/(60*60);//hover
//        $x=($a - $b)/(60);//mint
//        $x=($a - $b);//second

//        echo $e->holding_date_ir.'';
//        echo $e->completion_date_ir.'';
//        echo $x;exit;

        if ($exhibition != null) {
            foreach ($exhibition as $e) {

                $time2 = $e->completion_date_ir;
//                $timeNew=date('Y/m/d');
                $oldTime = strtotime($e->completion_date_ir);
                $newTime = strtotime(date('Y/m/d'));
                if ($newTime > $oldTime) {

                    $activity = Activity::find()->where(['id_exhibition' => $e->id])->andWhere(['enable' => 1])->all();
                    foreach ($activity as $act) {
                        $act->enable = 0;
                        if ($act->save()){echo 1;}else{var_dump($act->getErrors());exit;}

                    }

                    $room = Room::find()->where(['enable' => 1])->andWhere(['id_exhibition' => $e->id])->all();
                    foreach ($room as $ro) {
                        $ro->enable = 0;
                        if ($ro->save()){echo 2;}else{var_dump($ro->getErrors());exit;}
                        $ro->save();
                    }

                    $participant = \backend\models\Participant::find()->where(['id_exhibitionn' => $e->id])->andWhere(['enable' => 1])->all();
                    foreach ($participant as $part) {

//                        $profile = Profile::find()->where(['id' => $part->id_company])->andWhere(['enable' => 1])->all();
//                        foreach ($profile as $pro) {
//                        $pro->enable = 0;
//                        $pro->save();
//                    }

                        $category = Category::find()->where(['enable' => 1])->andWhere(['id_participant' => $part->id])->all();
                        foreach ($category as $cat) {
                            $product = Product::find()->where(['id_category' => $cat->id])->all();
                            foreach ($product as $prod) {
                                $prod->enable = 0;
                                if ($prod->save()){echo 41;}else{var_dump($prod->getErrors());exit;}
                                $prod->save();
                            }
                            $cat->enable = 0;
                            if ($cat->save()){echo 42;}else{var_dump($cat->getErrors());exit;}
                            $cat->save();
                        }

                        $part->enable = 0;
//                        if ($part->save()){echo 3;}else{var_dump($pro->getErrors());exit;}
                        $part->save();
                    }


                    $e->enable=0;
                    if ($e->save()){echo 4;}else{var_dump($e->getErrors());exit;}
                    $e->save();
                    
                } else {
                    echo 0;
                    exit;
                }
//                $ttime=$e->completion_time;
//                $tim = explode("-", $time2);
//                $d1 = $tim[0];
//                $m1 = $tim[1];
//                $y1 = $tim[2];
//                //تاریخ دیتابیس
//                $dx = $y1 . $m1 . $d1;
//                $time3=(int)$time2;


//                echo $dx;exit;
//                echo date('Ymd');exit;
            }
//echo $time2;
//            $time = new jdf();
            //تاریخ امروز
//            $time1 = $time->date('d/m/Y');
            //
//            $tim = explode("/", $time1);
//            $d2 = $tim[0];
//            $m2 = $tim[1];
//            $y2 = $tim[2];
//            $dx1 = $y2 . $m2 . $d2;
//            $time2=(int)$time1;
//
//echo $time2;
//echo $time1;
//            $str = strtotime(date('Y/m/d'));
//
////           $str2= gmdate('Y/m/d',$str);
//            $str2 = date('Y/m/d', $str);
//            $str1 = strtotime($e->completion_date_ir);
//            $str11 = gmdate(('Y/m/d'), $str1);
//            $str2 = strtotime(date('Y/m/d'));
//            $str22 = gmdate(('Y/m/d'), $str2);
//
//
//            $st = $str1 - $str2;
//            $st1 = gmdate(('Y/m/d'), $st);
//            $ss = date('Y/m/d');
//            $x = $e->completion_date_ir;
//            $y = date('Y/m/d');
//            echo $x . " ";
//            echo $y . " ";
//            if ($str1 > $str2) {
//                echo 1;
//                foreach ($exhibition as $ee) {
//
//                }
//            } else {
//                echo 0;
//            }


//
//            $strt1=time($e->completion_date_ir);
//            $strt2=time(date('Y/m/d'));
//            $s=$strt2-$strt1;
//            echo $e->completion_date_ir." ";
//            echo $strt2." ";
//            echo $s;

//            $d1=time($ss,'Y,m,d');
//            $d2=ceil(($d1-time())/60/60/24);
//            echo "There are " . $d2 ." days until 4th of July.";
//            echo $st;


//            $day = date("D",$str2);
//            echo strtoupper($day);


//
//            $diff=abs(strtotime($e->completion_date_ir)-strtotime(date('Y/m/d')));
//                    $years=floor($diff/(365*60*60*24));
//                   $months=floor(($diff-$years*365*60*60*24)/(30*60*60*24));
//                    $days=floor(($diff-$years*365*60*60*24-$months*30*60*60*24)/(60*60*24));
//                    var_dump( $years, $months, $days)."   ";
//            echo $str1."  ";
//            echo $str11."  ";
//            echo $str2. "    ";
//            echo $str22."   ";
//            echo $st." ";
//            echo $st1."   ";
//            $time = strtotime('2001-11-14 -3 years -7 months -5 days');
//            echo $date = date("Y-m-d", $time)."  ";
//
//            $date=date_create($e->completion_date_ir);
//            date_sub($date,date_interval_create_from_date_string(date('Y/m/d')));
//            echo date_format($date,"Y-m-d")."   ";
//
//
//            $date=date_create("2013-03-15");
//            date_sub($date,date_interval_create_from_date_string("440 days"));
//            echo date_format($date,"Y-m-d")."  ";
//
////
//            $date = "$e->completion_date_ir";
//            $newdate = strtotime ( '-3 day' , strtotime ( $date ) ) ;
//            $newdate = date ( 'Y-m-j' , $newdate );
//
//            echo $newdate;
//            exit;
//
//                    $date1 = new DateTime($time2);
//                    $date2 = new DateTime($time1);

//            $str3=strtotime(date('Y/m/d'));


//            echo $dx;
////            echo $dx1;
//            $str2= strtotime($d2)-strtotime($d1);
//            $str3= strtotime($d1)-strtotime($d2);
//            echo $str2;
//            echo $str3;



//            $x=strtotime("now");
//            $date = '2009-12-06';
//            // End date
//            $end_date = '2020-12-31';
//            $dx=(int)$dx;
//            $time1=(int)$time1;
////            $d1=(int)$d1;
////            $d2=(int)$d2;
////            echo $time1;
//
//           $d=$time1-$dx;
//            echo $d;exit;


//            $date1=date_($dx);
//            $date2=date_create($time1);
//            $diff=date_diff($date1,$date2);
//            echo $date1;exit;
//     $dx=date_create_from_format('y/m/d',$dx);
//     $time1=date_create_from_format('ymd',$time1);
//            $i=date_diff($dx,$time1);
//            echo $i->for;exit;
//


//            $daysTilNextMonth = ($firstDayNextMonth - time()) / (24 * 3600);
//        $firstDayNextMonth = strtotime('');


//        }
//    }
//        $transaction=Yii::$app->db->beginTransaction();
//        try{
//            $exhibition=Exhibitionn::find()->where(['enable'=>1])->all();
//            $time= new jdf();
//            $time1= $time->date('Y/m/d');
//            $tim = explode("/", $time1);
//            $d = $tim[0];
//            $m = $tim[1];
//            $y = $tim[2];
//
//            $dy=$y.$m.$d;
//
//            echo "    ";
//
//            if ($exhibition!=null){
//                foreach ($exhibition as $e){
//                    $time2=$e->completion_date;
//                    $tim = explode("/", $time2);
//                    $d1 = $tim[0];
//                    $m1 = $tim[1];
//                    $y1 = $tim[2];
//                    $dx=$y.$m.$d;
//
////                    $diff=abs(strtotime($time2)-strtotime($dy));
////                    $years=floor($diff/(365*60*60*24));
////                    $months=floor(($diff-$years*365*60*60*24)/(30*60*60*24));
////                    $days=floor(($diff-$years*365*60*60*24-$months*30*60*60*24)/(60*60*24));
////                    var_dump("%d years, %d months, %d days\n", $years, $months, $days);
//
////                    $date1 = new DateTime($time2);
////                    $date2 = new DateTime($time1);
////
////                    var_dump($date1 == $date2);
////                    var_dump($date1 < $date2);
////                    var_dump($date1 > $date2);
//
//                    exit;
//
//
//
//
//
//
//
//                }
//            }
//
////            $exhibitTime=
//        }//end try
//        catch (Exception $e){
//            $transaction->rollBack();
//            $this->refresh();
//        }
//        return $this->render('endtime');
        }
    }

    /**
     * Finds the Exhibitionn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exhibitionn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exhibitionn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
