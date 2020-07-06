<?php

namespace backend\controllers;

use backend\models\Img;
use backend\models\Participant;
use backend\models\Profile;
use common\models\User;
use PHPUnit\Framework\Exception;
use Yii;
use backend\models\Backgrond;
use backend\models\BackgrondSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BackgrondController implements the CRUD actions for Backgrond model.
 */
class BackgrondController extends Controller
{
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
     * Lists all Backgrond models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BackgrondSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Backgrond model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Backgrond model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $transaction=Yii::$app->db->beginTransaction();
        try {
            //برای اینکه الکی رکوردهای اضافی تو دیتابیس ذخیره نشن
            //چون توی جدول رکورد فقط با یک اسم خاص ذخیره میشه و برای اندروید
            //فقط اون اسم میره تو پوشه آپلود هم عکس فقط بایک اسم ذهیزه میشه

            $back = Backgrond::find()->one();
//            if ($back) {
//                echo $back->id;exit;

//                return $this->redirect(['upload', 'id'=> $back->id]);
//                return $this->redirect(['view', 'id' => $model->id]);

//            } else {
                $user = User::findOne(Yii::$app->user->getId());
                $profile = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
                $booth = $profile->id_user;
//            $participant=Participant::find()->where(['enable'=>1])->andWhere(['id_company'=>$profile->id])->one();
//            $booth=$participant->id;

                $img = new Img();
                $model = new Backgrond();

                if ($model->load(Yii::$app->request->post())) {

                    $model->file = UploadedFile::getInstance($model, 'file');
                    if ($model->file != null) {

                        if ($model->file->baseName == 'background') {
                            if ($model->file->extension == 'jpg') {


                                if ($model->validate()) {

                                    $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $model->file->baseName . '.' . $model->file->extension);

                                    //چون عکس همیشه با یک اسم و مشخصات ثبت میشه
                                    //اول خودم ایجادش کردم و کد مربوط به ثبت در
                                    //جدول img رو کامنت کردم
//                                    if ($img->fileImg == 'background.jpg') {
////                                echo 1;exit;
//
//                                        if ($img->save()) {
//                                            $im = $img->id;
//                                            echo $im;
//                                        }//end if save
//                                        else {
//                                            $im = -1;
//                                            echo $im;
//                                        }//end else save
//                                    }//end if
//                                    else {
//                                        $background = Img::find()->where(['id' => $back->backgrondImg])->one();
//                                        if ($background) {
//                                            $im = $background->id;
//                                        } else {
//                                            if ($img->save()) {
//                                                $im = $img->id;
//                                                echo $im;
//                                            }//end if save
//                                            else {
//                                                $im = -1;
//                                                echo $im;
//                                            }//end else save
//                                        }
//
//                                    }

//                                    $model->backgrondImg = $im;
                                    $model->backgrondImg = 91;//قبلا ثبت شده و ثابته
                                    if ($model->save()) {
                                        $transaction->commit();
                                        $_SESSION['error'] = 'عکس ذخیره شد';
                                        return $this->redirect(['view', 'id' => $model->id]);

                                    }
                                }//end if validate

                                else {
                                    $_SESSION['error'] = 'عکس validate نشد';
                                    return $this->render('create', [
                                        'model' => $model,
                                    ]);
                                }//end else validate
                            }//end if extension
                            else {
                                $_SESSION['error'] = 'لطفا فرمت عکس را به jpg تغییر دهید';
                                return $this->render('create', [
                                    'model' => $model,
                                ]);
                            }//end else extension
                        }//enf if baseName
                        else {
                            $_SESSION['error'] = 'لطفا نام عکس را به background تغییر دهید';
                            return $this->render('create', [
                                'model' => $model,
                            ]);
                        }//end else baseName
                    }//end if file != null
                    else {
                        $_SESSION['error'] = 'لطفا اول عکس اپلود کنید';
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }//end else file ==null


//                
                }//end if load
                else {

                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }//end else load
//            }//end else $back
            }//end try
        catch
            (Exception $e){
                $transaction->rollBack();
                $this->refresh();
            }//end catch



    }

    /**
     * Updates an existing Backgrond model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    //در قسمت update فقط فایل عکس در پوشه آپلود تغییر میکند
    //همراه فیلد های جدول background غیر از فیلد backgroundImg
    public function actionUpdate($id)
    {
        $transaction=Yii::$app->db->beginTransaction();
        try{
            $back=Backgrond::find()->where(['id'=>$id]);
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file != null) {

                    if ($model->file->baseName == 'background') {
                        if ($model->file->extension == 'jpg') {


                            if ($model->validate()) {

                                $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $model->file->baseName . '.' . $model->file->extension);

                                $model->backgrondImg = 91;
                                if ($model->save()) {
                                    $transaction->commit();
                                    $_SESSION['error'] = 'عکس ذخیره شد';
                                    return $this->redirect(['view', 'id' => $model->id]);

                                }
                            }//end if validate

                            else {
                                $_SESSION['error'] = 'عکس validate نشد';
                                return $this->render('create', [
                                    'model' => $model,
                                ]);
                            }//end else validate
                        }//end if extension
                        else {
                            $_SESSION['error'] = 'لطفا فرمت عکس را به jpg تغییر دهید';
                            return $this->render('create', [
                                'model' => $model,
                            ]);
                        }//end else extension
                    }//enf if baseName
                    else {
                        $_SESSION['error'] = 'لطفا نام عکس را به background تغییر دهید';
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }//end else baseName
                }//end if file != null
                else {
                   $model->backgrondImg=91;
                    if ($model->save()){
                        $transaction->commit();
                        $_SESSION['error'] = 'عکس ذخیره شد';
                        return $this->redirect(['view', 'id' => $model->id]);
                    }//end if save
                    else{}//end else save;
                }//end else file ==null

        }

            return $this->render('update', [
                'model' => $model,
            ]);
        }//end try
        catch (Exception $e){
            $transaction->rollBack();
            $this->refresh();
        }
    }

    /**
     * Deletes an existing Backgrond model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws $img->delete() if the model cannot be found
     */
    
    public function actionDelete($id)
    {
        $transaction=Yii::$app->db->beginTransaction();
        try{
            $model=$this->findModel($id);

            if ($id==10){
                $_SESSION['error']='شما قادر به حذف این رکورد نیستید';
                return $this->redirect(['index']);
            }else{
                $model->delete();
                $transaction->commit();
                return $this->redirect(['index']);
            }
            
        }//end try
        catch(Exception $e){
            $transaction->rollBack();
            $this->refresh();
        }//end catch

    }

    /**
     * Finds the Backgrond model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Backgrond the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Backgrond::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
