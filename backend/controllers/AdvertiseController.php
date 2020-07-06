<?php

namespace backend\controllers;

use PHPUnit\Framework\Exception;
use Yii;
use backend\models\Advertise;
use backend\models\AdvertiseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdvertiseController implements the CRUD actions for advertise model.
 */
class AdvertiseController extends Controller
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
        $transaction=yii::$app->db->beginTransaction();
        try{
            $model=new Advertise();
            if ($model->load(Yii::$app->request->post())){
                
                $model->enable=1;
                
                if ($model->save()){
                    $transaction->commit();
                    $_SESSION['error']='اطلاعات با موفقیت ذخیره شدند';
                    return $this->redirect(['view', 'id' => $model->id]);
                }//end if save
                else{
                    $_SESSION['error']='خطا در ذخیره سازی';
                    return $this->render('create',[
                        'model'=>$model,
                    ]);
                    
                }//end else save
            }//end if load
            else{
                return $this->render('create',[
                    'model'=>$model,
                ]);
            }//end else load
        }//end try
        catch(Exception $e){
            $transaction->rollBack();
            $this->refresh();
        }//end catch
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
        $transaction=Yii::$app->db->beginTransaction();
        try{
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                if ($model->save()){
                    
                    $transaction->commit();
                    $_SESSION['error']='ویرایش ثبت شد';
                    return $this->redirect(['view', 'id' => $model->id]);
                }//end if save
                else{

                    $_SESSION['error']='خطا در ذخیره اطلاعات';
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }//end else save

            }//end if load
            else{

                return $this->render('update', [
                    'model' => $model,
                ]);
            }//end else load
        }//end try
        catch(Exception $e){
            $transaction->rollBack();
            $this->refresh();
        }//end catch

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
        $transaction=Yii::$app->db->beginTransaction();
        try{
            
            $model=$this->findModel($id);
            if ($model->id==1){
                $_SESSION['error']='شما قادر به حذف این رکورد نمیباشید';
                return $this->redirect(['index']);
            }else{
                $model->delete();
                $transaction->commit();
                return $this->redirect(['index']);
            }
        }
        catch(Exception $e){
            $transaction->rollBack();
            $this->refresh();
        }
        

      
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
