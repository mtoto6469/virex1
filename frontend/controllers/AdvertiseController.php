<?php

namespace frontend\controllers;

use common\components\jdf;
use common\models\User;
use frontend\models\Factor;
use frontend\models\Factoradvertise;
use frontend\models\Participant;
use frontend\models\Productmove;
use frontend\models\Profile;
use PHPUnit\Framework\Exception;
use Yii;
use frontend\models\Advertise;
use frontend\models\AdvertiseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdvertiseController implements the CRUD actions for advertise model.
 */
class AdvertiseController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all advertise models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdvertiseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single advertise model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
//        var_dump();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new advertise model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Advertise();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing advertise model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing advertise model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionEndtime(){
        $factor=Factor::find()->where(['enable'=>1])->andWhere(['buyAdvertise'=>1])->all();
        foreach ($factor as $f){
            $timeAdvertise=$f->date;
            $enable=
            $a=str_replace('-','/',$timeAdvertise);
            $nextDay=date('Y-m-d',strtotime($a.'+30days'));
            $today=date('Y/m/d');
            if ($nextDay==$today){
                $f->enable=0;
                $f->save();
            }


        }
        
        exit;
    }

    
    public function actionAdvertise(){
        $transaction=Yii::$app->db->beginTransaction();
        try{
            $advertise=Advertise::find()->where(['enable'=>1])->all();
            return $this->render('advertise',[
                'advertise'=>$advertise,
            ]);
        }//end try
        catch(Exception $e){
            $transaction->rollBack();
            $this->refresh();
        }//end catch
        
    }

    public function actionSabt(){


        $transaction=Yii::$app->db->beginTransaction();
        try{

//            $session = Yii::$app->session;
//            if (!$session->isActive) {
//                $session->open();
//            } else {
//            }
//
//            $id=$_SESSION['price1'];
//           echo $id;exit;
            $id=$_GET['id'];

            $advertise=Advertise::find()->where(['enable'=>1])->andWhere(['id'=>$id])->one();
            $model=new Factoradvertise();

            //برای فهمیدن اینکه آیا کس در نمایشگاه فعلی غرفه داره یا نه
            $user=User::findOne(Yii::$app->user->getId());
            $profile=Profile::find()->where(['enable'=>1])->andWhere(['id_user'=>$user->id])->one();
            $idCompany=$profile->id;
            $idUser=$profile->id_user;
            
            //چک کنیم ببینیم کاربر در حال حاضر غرفه ای ثبت کرده یا نه
//            $participant=Participant::find()->where(['enable'=>1])->andWhere(['buy'=>1])->andWhere(['id_company'=>$profile->id])->one();
//            if ($participant){$idParticipant=$participant->id;}else{$idParticipant= -1;}
//            
           

            if ($model->load(Yii::$app->request->post())){


                $volume=$model->volume;
                $price=$model->price;
                
                $model->file=UploadedFile::getInstance($model,'file');
                $model->file1=UploadedFile::getInstance($model,'file1');
                //فیلم و عکس اجباری هستند و نباید خالی باشن
                if ($model->file != null && $model->file1 != null){

                    $size=$model->file->size;
//                    echo $size;exit;
                    $totalVolume=$volume * 1024000;

                    if ($model->file->size <= $totalVolume){

                        if ($model->validate()){
                            //ثبت فیلم و عکس در جدول
                            $img=new Productmove();
                            if ($model->file != null){
                                $basename1='Advertise'.$model->file->extension;
                                $model->file->saveAs('./../../upload/video/'.$basename1.'.'.$model->file->extension);
                                $movie=$basename1.'.'.$model->file->extension;
                            }
                            if ($model->file1 != null){
                                $basename2='Advertise'.$model->file->extension;
                                $model->file1->saveAs('./../../upload/images/'.$basename2.'.'.$model->file1->extension);
                                $movie1=$basename2.'.'.$model->file1->extension;
                            }

                            $img->alt='ثبت تبلیغات در نمایشگاه مجازی vireex';
                            $img->move1=$movie;
                            $img->move2='void';
                            $img->move3=$movie1;
                            $img->move4='void';
                            $img->id_product= -1;
                            $img->enable= 1;

                            if ($img->save()){
                                $im=$img->id;
                            }else{
                                $_SESSION['error']='خطا! در ذخیره سازی فایل';
                                return $this->render('adRegistration',[
                                    'model'=>$model,
                                    'advertise'=>$advertise,
//                                'participant'=>$participant,
                                ]);
                            }
                            //اگه غرفه دار بود
                            $participant=Participant::find()->where(['enable'=>1])->andWhere(['id_company'=>$profile->id])->one();
                            if ($participant){
                                $idParticipant=$participant->id;
                            }else{
                                $idParticipant= 0;
                            }
                            


                            //ثبت اطلاعات در جدوا factorAdvertise
                            $factor=new Factor();

                            $factor->id_exhibition= -1;
                            $factor->id_room= -1;
                            $factor->volume=$volume;
                            $factor->id_advertise=$im;
                            $factor->id_user=$idUser;
                            $factor->id_company=$idCompany;
                            $factor->price=$price;
                            $factor->atu='-1';
                            $factor->ref='-1';
                            $factor->visible= -1;
                            $factor->print= -1;
                            $factor->endPrice= $factor->price;
                            $factor->enable=1;
                            $factor->id_participant=$idParticipant;

                            $date=new jdf();
                            $factor->date=date('Y/m/d');
                            $factor->date_ir=$date->date('Y/m/d');
                            $factor->time=date('h:m:s');
                            $factor->time_ir=$date->date('h:m:s');

                            if ($factor->save()){

                                $transaction->commit();

                                return $this->redirect(['paymentp/index', 'id' => $factor->id]);
                            }//end if saved factor
                            else{
                                var_dump($factor->getErrors());exit;
                            }//end else not save factor

                        }//end if validate
                        else{
//                            echo $totalVolume;exit;
                            $_SESSION['error']='validate نشد';
                            return $this->render('adRegistration',[
                                'model'=>$model,
                                'advertise'=>$advertise,
//                                'participant'=>$participant,
                            ]);
                        }//end else validate
                    }
                    else{
//                        echo $totalVolume;exit;
                        $_SESSION['error']='حجم فایل بیشتر از مقدار درخواست شده میباشد';
                        return $this->render('adRegistration',[
                            'model'=>$model,
                            'advertise'=>$advertise,
//                            'participant'=>$participant,
                        ]);
                    }
                    
                }//end id $model==null
                else{
                    $_SESSION['error']='عکس و فیلم باید آپلود شود';
                    return $this->render('adRegistration',[
                        'model'=>$model,
                        'advertise'=>$advertise,
//                'participant'=>$participant,
                    ]);
                }
                
            }//end if load
            else{

                return $this->render('adRegistration',[
                    'model'=>$model,
                    'advertise'=>$advertise,
//                'participant'=>$participant,
                ]);
            }
        }//end try
        catch(Exception $e){
            $transaction->rollBack();
            $this->refresh();
        }//end catch

    }
    /**
     * Finds the advertise model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Advertise the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advertise::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    
}
