<?php

namespace backend\controllers;

use backend\models\Imgupload;
use backend\models\Participant;
use backend\models\Profile;
use common\models\User;
use PHPUnit\Framework\Exception;
use Yii;
use backend\models\Img;
use backend\models\ImgSearch;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ImgController implements the CRUD actions for Img model.
 */
class ImgController extends Controller
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
     * Lists all Img models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImgSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Img model.
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
     * Creates a new Img model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//        $transaction=Yii::$app->db->beginTransaction();
        try {

            $model = new Img();
            $modelup = new Imgupload();

            $user = User::findOne(Yii::$app->user->getId());
//            $profile=Profile::find()->where(['id_user'=>$user->id])->one();
//            $participant=Participant::find()->where(['id_company'=>$profile->id])->one();
            $booth = $user->id;


//            $model = new Img();
//            $modelup = new \frontend\models\Imgupload();

            if ($model->load(Yii::$app->request->post()) && $modelup->load(Yii::$app->request->post())) {

                $modelup->imageFile = UploadedFile::getInstance($modelup, 'imageFile');
                $modelup->imageFile1 = UploadedFile::getInstance($modelup, 'imageFile1');
                $modelup->imageFile2 = UploadedFile::getInstance($modelup, 'imageFile2');
//                if ($modelup->imageFile != null) {
                if ($modelup->validate()) {
                    if ($modelup->imageFile != null){
                        if ($modelup->imageFile->extension == 'pdf') {
                            $modelup->imageFile->saveAs(Yii::getAlias('@upload') . '/upload/files/' . $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension);
                            $model->fileImg = $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension;
                            $model->id_participant=$booth;
//
                        } elseif ($modelup->imageFile->extension == 'png' || $modelup->imageFile->extension == 'jpg' || $modelup->imageFile->extension == 'jpeg') {
                            $modelup->imageFile->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension);
                            $model->fileImg = $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension;
                            $model->id_participant=$booth;
//
                        } elseif ($modelup->imageFile->extension == 'gif' || $modelup->imageFile->extension == 'mp4') {
                            $modelup->imageFile->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension);
                            $model->fileImg = $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension;
                            $model->id_participant=$booth;
//
                        } else {

                            $modelup->imageFile->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension);
                            $model->fileImg = $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension;
                            $model->id_participant=$booth;
//
//                        var_dump($modelup->imageFile->extension);exit();
                        }
//
                    }else{$modelup->imageFile='void';}
                    if ($modelup->imageFile1 != null){
                        if ($modelup->imageFile1->extension == 'pdf') {
                            $modelup->imageFile1->saveAs(Yii::getAlias('@upload') . '/upload/files/' . $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension);
                            $model->filePdf = $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension;
                            $model->id_participant=$booth;
//
                        } elseif ($modelup->imageFile1->extension == 'png' || $modelup->imageFile1->extension == 'jpg' || $modelup->imageFile1->extension == 'jpeg') {
                            $modelup->imageFile1->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension);
                            $model->filePdf = $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension;
                            $model->id_participant=$booth;
//
                        } elseif ($modelup->imageFile1->extension == 'gif' || $modelup->imageFile1->extension == 'mp4') {
                            $modelup->imageFile1->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension);
                            $model->filePdf = $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension;
                            $model->id_participant=$booth;
//
                        } else {
                            $modelup->imageFile1->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension);
                            $model->filePdf = $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension;
                            $model->id_participant=$booth;
//
//                        var_dump($modelup->imageFile->extension);exit();
                        }

                    }else{$modelup->imageFile1="void";}

                    if ($modelup->imageFile2 != null){
                        if ($modelup->imageFile2->extension == 'pdf') {
                            $modelup->imageFile2->saveAs(Yii::getAlias('@upload') . '/upload/files/' . $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension);
                            $model->fileMove = $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension;
                            $model->id_participant=$booth;
//
                        } elseif ($modelup->imageFile2->extension == 'png' || $modelup->imageFile2->extension == 'jpg' || $modelup->imageFile2->extension == 'jpeg') {
                            $modelup->imageFile2->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension);
                            $model->fileMove = $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension;
                            $model->id_participant=$booth;
//
                        } elseif ($modelup->imageFile2->extension == 'gif' || $modelup->imageFile2->extension == 'mp4') {
                            $modelup->imageFile2->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension);
                            $model->fileMove = $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension;
                            $model->id_participant=$booth;
//
                        } else {
                            $modelup->imageFile2->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension);
                            $model->fileMove = $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension;
                            $model->id_participant=$booth;
//
//                 
                        }

                    }else{$modelup->imageFile2="void";}







                    if ($model->save()) {
//                            $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        var_dump($model->getErrors());exit;

//                            return $this->render('create', [
//                                'model' => $model,
//                                'modelup' => $modelup,
//                            ]);
                    }
                } else {
                    return $this->render('create', [
                        'model' => $model,
                        'modelup' => $modelup,
                    ]);
                }
//                } else {
//                    return $this->render('create', [
//                        'model' => $model,
//                        'modelup' => $modelup,
//                    ]);
//                }

//            return $this->redirect(['view', 'id' => $model->id]);
            } else {

                return $this->render('create', ['model' => $model,
                    'modelup' => $modelup,]);
            }
        }catch (Exception $e) {
//            $transaction->rollBack();
//            Yii::$app->user->setFlash('error', "{$e->getMessage()}");
            $this->refresh();
        }
    }


    /**
     * Updates an existing Img model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $user = User::findOne(Yii::$app->user->getId());
            $booth=$user->id;
            $model = $this->findModel($id);
            $modelup = new Imgupload();
            if ($model->load(Yii::$app->request->post())) {
                $fileImg= $model->fileImg;
                $fileMove= $model->fileMove;
                $filePdf= $model->filePdf;

                $modelup->imageFile = UploadedFile::getInstance($modelup, 'imageFile');

                if ($modelup->validate()) {
                    if ($modelup->imageFile != null) {

                        if ($modelup->imageFile->extension == 'pdf') {
                            $modelup->imageFile->saveAs(Yii::getAlias('@upload') . '/upload/files/' . $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension);
                            $model->fileImg = $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension;
                            $model->id_participant = $booth;
//
                        } elseif ($modelup->imageFile->extension == 'png' || $modelup->imageFile->extension == 'jpg' || $modelup->imageFile->extension == 'jpeg') {                            $modelup->imageFile->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension);
                            $model->fileImg = $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension;

                            $model->id_participant = $booth;
//
                        } elseif ($modelup->imageFile->extension == 'gif' || $modelup->imageFile->extension == 'mp4') {
                            $modelup->imageFile->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension);
                            $model->fileImg = $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension;
                            $model->id_participant = $booth;
//
                        } else {

                            $modelup->imageFile->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension);
                            $model->fileImg = $modelup->imageFile->baseName . '.' . $modelup->imageFile->extension;
                            $model->id_participant = $booth;
//
//                        var_dump($modelup->imageFile->extension);exit();
                        }
                    }
                    else {

                        $modelup->imageFile = $fileImg;
                    }
                    if ($modelup->imageFile1 != null) {
                        if ($modelup->imageFile1->extension == 'pdf') {
                            $modelup->imageFile1->saveAs(Yii::getAlias('@upload') . '/upload/files/' . $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension);
                            $model->filePdf = $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension;
                            $model->id_participant = $booth;
//
                        } elseif ($modelup->imageFile1->extension == 'png' || $modelup->imageFile1->extension == 'jpg' || $modelup->imageFile1->extension == 'jpeg') {
                            $modelup->imageFile1->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension);
                            $model->filePdf = $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension;
                            $model->id_participant = $booth;
//
                        } elseif ($modelup->imageFile1->extension == 'gif' || $modelup->imageFile1->extension == 'mp4') {
                            $modelup->imageFile1->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension);
                            $model->filePdf = $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension;
                            $model->id_participant = $booth;
//
                        } else {
                            $modelup->imageFile1->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension);
                            $model->filePdf = $modelup->imageFile1->baseName . '.' . $modelup->imageFile1->extension;
                            $model->id_participant = $booth;
//
//                        var_dump($modelup->imageFile->extension);exit();
                        }

                    } else {
                        $modelup->imageFile1 = $fileMove;
                    }

                    if ($modelup->imageFile2 != null) {
                        if ($modelup->imageFile2->extension == 'pdf') {
                            $modelup->imageFile2->saveAs(Yii::getAlias('@upload') . '/upload/files/' . $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension);
                            $model->fileMove = $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension;
                            $model->id_participant = $booth;
//
                        } elseif ($modelup->imageFile2->extension == 'png' || $modelup->imageFile2->extension == 'jpg' || $modelup->imageFile2->extension == 'jpeg') {
                            $modelup->imageFile2->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension);
                            $model->fileMove = $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension;
                            $model->id_participant = $booth;
//
                        } elseif ($modelup->imageFile2->extension == 'gif' || $modelup->imageFile2->extension == 'mp4') {
                            $modelup->imageFile2->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension);
                            $model->fileMove = $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension;
                            $model->id_participant = $booth;
//
                        } else {
                            $modelup->imageFile2->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension);
                            $model->fileMove = $modelup->imageFile2->baseName . '.' . $modelup->imageFile2->extension;
                            $model->id_participant = $booth;
//
//                        var_dump($modelup->imageFile->extension);exit();
                        }

                    } else {
                        $modelup->imageFile2 = $filePdf;
                    }

                    if ($model->save()) {
                            $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        var_dump($model->getErrors());
                        exit;

//                            return $this->render('create', [
//                                'model' => $model,
//                                'modelup' => $modelup,
//                            ]);
                    }
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'modelup' => $modelup
                ]);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::$app->user->satFlash('error', "{$e->getMessage()}");
            $this->refresh();
        }
    }


    /**
     * Deletes an existing Img model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    //چون من در قسمت upload خودم 3 تا پوشه مختلف داشتم و میخاستم با خذف فایل فای کامل از هاست من حدف بشه اومدم
    //حذف کامل در دیتابیس وجود ندارد enable=0
    public function actionDelete($id)
    {
//        $transaction=Yii::$app->db->beginTransaction();
        try {
            $model = $this->findModel($id);

            if ($name = $model->fileImg) {
                // 1- ادرس جایی که فایل ها در اون ذخیره هستن رو در یک متغیر ذخیره کردم
                $all = Yii::getAlias('@upload') . '/upload/files/' . $name;

                //2- حالا چون آدرس فایل من به شکل C:\xampp\htdocs/upload/files/as.jpg بود بر اساس "/" جدا کردم
                $allexpload = explode("/", $all);
//            var_dump($allexpload);exit;

                //3 از اونجایی که زمانی که فایل ها جدا شدن در کل به 3 قسمت تقسیم میشن دیگه از count استفاده نکردم
                // چون این برای همیشه در آدرس من ثابت است و اسم فایل من همیشه سومین است پس از $allexpload[3] استفاده کردم
                // همیشه آرایه سوم میباشد
                $pasvand = explode(".", $allexpload[3]);

                //ارایه 0 (صفر)اسم فایل
                $filename = $pasvand[0];
                echo $filename;

                //آرایه 1 (یک) پسوند فایل
                $filepas = $pasvand[1];
//                echo $filepas;

                if ($filepas == 'pdf') {

                    if (unlink(Yii::getAlias('@upload') . '/upload/files/' . $name)) {
                        $model->enable = 0;
                        if ($model->save()) {
                            return $this->redirect(['index']);
                        } else {
                            var_dump($model->getErrors($model->title));
                        }
                    }//end if unlink
                }//enf if pdf

                elseif ($filepas == 'gif' || $filepas == 'mp4') {

                    if (unlink(Yii::getAlias('@upload') . '/upload/files/' . $name)) {
                        $model->enable = 0;
                        if ($model->save()) {
                            return $this->redirect(['index']);
                        } else {
                            var_dump($model->getErrors($model->title));
                        }

                    }//end if unlink
                }//end if gif,mp4

                elseif ($filepas == 'png' || $filepas == 'jpg' || $filepas == 'jpeg') {

                    if (unlink(Yii::getAlias('@upload') . '/upload/images/' . $name)) {
                        $model->enable = 0;
                        if ($model->save()) {
                            return $this->redirect(['index']);
                        } else {
                            var_dump($model->getErrors($model->fileImg));
                        }
                    }//end if unlink
                }// end if  png,jpg,jpeg

                //if Yii::getAlias نشده
                else {
                    echo 55;
                    exit;
                }

            }
            if ($name1 = $model->filePdf) {
                // 1- ادرس جایی که فایل ها در اون ذخیره هستن رو در یک متغیر ذخیره کردم
                $all1 = Yii::getAlias('@upload') . '/upload/files/' . $name1;

                //2- حالا چون آدرس فایل من به شکل C:\xampp\htdocs/upload/files/as.jpg بود بر اساس "/" جدا کردم
                $allexpload1 = explode("/", $all1);
//            var_dump($allexpload);exit;

                //3 از اونجایی که زمانی که فایل ها جدا شدن در کل به 3 قسمت تقسیم میشن دیگه از count استفاده نکردم
                // چون این برای همیشه در آدرس من ثابت است و اسم فایل من همیشه سومین است پس از $allexpload[3] استفاده کردم
                // همیشه آرایه سوم میباشد
                $pasvand1 = explode(".", $allexpload1[3]);

                //ارایه 0 (صفر)اسم فایل
                $filename1 = $pasvand1[0];
                echo $filename1;

                //آرایه 1 (یک) پسوند فایل
                $filepas1 = $pasvand1[1];
                echo $filepas1;

                if ($filepas1 == 'pdf') {

                    if (unlink(Yii::getAlias('@upload') . '/upload/files/' . $name1)) {
                        $model->enable = 0;
                        if ($model->save()) {
                            return $this->redirect(['index']);
                        } else {
                            var_dump($model->getErrors($model->filePdf));
                        }
                    }//end if unlink
                }//enf if pdf

                elseif ($filepas1 == 'gif' || $filepas1 == 'mp4') {

                    if (unlink(Yii::getAlias('@upload') . '/upload/files/' . $name1)) {
                        $model->enable = 0;
                        if ($model->save()) {
                            return $this->redirect(['index']);
                        } else {
                            var_dump($model->getErrors($model->filePdf));
                        }

                    }//end if unlink
                }//end if gif,mp4

                elseif ($filepas1 == 'png' || $filepas1 == 'jpg' || $filepas1 == 'jpeg') {

                    if (unlink(Yii::getAlias('@upload') . '/upload/images/' . $name1)) {
                        $model->enable = 0;
                        if ($model->save()) {
                            return $this->redirect(['index']);
                        } else {
                            var_dump($model->getErrors($model->filePdf));
                        }
                    }//end if unlink
                }// end if  png,jpg,jpeg

                //if Yii::getAlias نشده
                else {
                    echo 55;
                    exit;
                }

            }
            if ($name2 = $model->fileMove) {
                // 1- ادرس جایی که فایل ها در اون ذخیره هستن رو در یک متغیر ذخیره کردم
                $all1 = Yii::getAlias('@upload') . '/upload/video/' . $name2;

                //2- حالا چون آدرس فایل من به شکل C:\xampp\htdocs/upload/files/as.jpg بود بر اساس "/" جدا کردم
                $allexpload1 = explode("/", $all1);
//            var_dump($allexpload);exit;

                //3 از اونجایی که زمانی که فایل ها جدا شدن در کل به 3 قسمت تقسیم میشن دیگه از count استفاده نکردم
                // چون این برای همیشه در آدرس من ثابت است و اسم فایل من همیشه سومین است پس از $allexpload[3] استفاده کردم
                // همیشه آرایه سوم میباشد
                $pasvand1 = explode(".", $allexpload1[3]);

                //ارایه 0 (صفر)اسم فایل
                $filename1 = $pasvand1[0];
                echo $filename1;

                //آرایه 1 (یک) پسوند فایل
                $filepas1 = $pasvand1[1];
                echo $filepas1;

                if ($filepas1 == 'mp4' ||$filepas1 == 'gif' ) {

                    if (unlink(Yii::getAlias('@upload') . '/upload/video/' . $name2)) {
                        $model->enable = 0;
                        if ($model->save()) {
                            return $this->redirect(['index']);
                        } else {
                            var_dump($model->getErrors($model->fileMove));
                        }
                    }//end if unlink
                }//enf if pdf

                elseif ($filepas1 == 'gif' || $filepas1 == 'mp4') {

                    if (unlink(Yii::getAlias('@upload') . '/upload/files/' . $name2)) {
                        $model->enable = 0;
                        if ($model->save()) {
                            return $this->redirect(['index']);
                        } else {
                            var_dump($model->getErrors($model->filePdf));
                        }

                    }//end if unlink
                }//end if gif,mp4

                elseif ($filepas1 == 'png' || $filepas1 == 'jpg' || $filepas1 == 'jpeg') {

                    if (unlink(Yii::getAlias('@upload') . '/upload/images/' . $name2)) {
                        $model->enable = 0;
                        if ($model->save()) {
                            return $this->redirect(['index']);
                        } else {
                            var_dump($model->getErrors($model->fileMove));
                        }
                    }//end if unlink
                }// end if  png,jpg,jpeg

                //if Yii::getAlias نشده
                else {
                    echo 55;
                    exit;
                }

            }

        }//end try
        catch (Exception $e) {
//           $transaction->rollBack();
//           Yii::$app->user->setFlash('error',"{$e->getMessage()}");
            $this->refresh();
        }//end catch
    }//end function

    /**
     * Finds the Img model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Img the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Img::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
