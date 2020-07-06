<?php

namespace frontend\controllers;

use common\models\User;
use frontend\Imgupload;
use frontend\Imgupload1;
use frontend\Imgupload2;
use frontend\models\Participant;
use frontend\models\Profile;
use PHPUnit\Framework\Exception;
use Yii;
use frontend\models\Img;
use frontend\models\ImgSearch;
use yii\web\Controller;
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
            $user=User::findOne(Yii::$app->user->getId());
            $profile=Profile::find()->where(['id_user'=>$user->id])->one();
            $participant=Participant::find()->where(['id_company'=>$profile->id])->one();
            $booth=$participant->id;

            $model = new Img();
            $modelup = new \frontend\models\Imgupload();

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
//                        var_dump($modelup->imageFile->extension);exit();
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Img model.
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
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
