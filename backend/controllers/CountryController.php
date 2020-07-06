<?php

namespace backend\controllers;

use backend\models\Countrymodel;
use backend\models\Img;
use common\models\User;
use Yii;
use backend\models\Country;
use backend\models\CountrySearch;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
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
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Country model.
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
     * Creates a new Country model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $user=User::findOne(Yii::$app->user->getId());
            $booth=$user->id;
            
            $model = new Country();
            $image = new Img();
            if ($model->load(Yii::$app->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file == null) {
                    $im = -1;
                }//end if file = null
                else {
                    if ($model->validate()) {
                        $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $model->file->baseName . '.' . $model->file->extension);

                        //save in database
                        $countryName = $model->file->baseName . '.' . $model->file->extension;
                        $image->fileMove = 'void';
                        $image->filePdf = 'void';
                        $image->fileImg = $countryName;
                        $image->alt = $countryName;
                        $image->uses = 'country';
                        $image->id_participant=$booth;

                        if ($image->save()) {
                            $im = $image->id;
                        }


                    }//end if validate
                    else {
                        $im= -1;
                    }//end else validate
                }//end else file != null
                $model->id_img=$im;
                if ($model->save()) {
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {

                }
//                $transaction->commit();
                return $this->render('create', [
                    'model' => $model,
                ]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } catch (ErrorException $e) {
            $transaction->rollBack();
            $this->refresh();
            throw $e;
        }
    }

    /**
     * Updates an existing Country model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $user=User::findOne(Yii::$app->user->getId());
            $booth=$user->id;
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                $image=Img::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_img])->one();
                $images=new Img();
                if ($model->file != null){
                    $model->file->saveAse(Yii::getAlias('@upload').'/upload/images/'.$model->file->basename.'.'.$model->extention);
                    $countryName = $model->file->baseName . '.' . $model->file->extension;
                    $images->fileMove = 'void';
                    $images->filePdf = 'void';
                    $images->fileImg = $countryName;
                    $images->alt = $countryName;
                    $images->uses = 'country';
                    $images->id_participant=$booth;

                    if ($images->save()) {
                        $im = $images->id;
                    }
                }//end if file != null
                else{
                    $im=$image->id;
                }//end else file = null
                $model->id_img=$im;
                if ($model->save()) {
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }//end if load
            else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }//end else load
        } catch (ErrorException $e) {
            $transaction->rollBack();
            $this->refresh();
            throw $e;
        }


    }

    /**
     * Deletes an existing Country model.
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
            $model->enable = 0;
            if ($model->save()) {
                $transaction->commit();
            }


            return $this->redirect(['index']);
        } catch (ErrorException $e) {
            $transaction->rollBack();

            $this->refresh();
        }

    }


    /**
     * Finds the Country model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Country the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Country::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
