<?php

namespace backend\controllers;

use Yii;
use backend\models\Factor;
use backend\models\FactorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FactorController implements the CRUD actions for Factor model.
 */
class FactorController extends Controller
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
     * Lists all Factor models.
     * @return mixed
     */
    public function actionIndex($visible,$print)
    {
        $searchModel = new FactorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$visible,$print);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Factor model.
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
     * Creates a new Factor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Factor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Factor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$visible,$print)
    {
        $model = $this->findModel($id);
        if ($visible==0 && $print==0){
            $model->visible=1;
            $model->save();
        }
        if ($visible==1 && $print==0){
            $model->print=1;
            $model->save();
        }

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }

        return $this->render('update', [
            'model' => $model,
            'visible'=>$visible,
            'print'=>$print,
        ]);
    }

    /**
     * Deletes an existing Factor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->enable=0;
        $model->visible=1;
        $model->print=1;
        if ($model->save()){
            return $this->redirect(['index',
                'visible'=>1,
                'print'=>1,
            ]);
        }//

        return $this->redirect(['index']);
    }

    /**
     * Finds the Factor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Factor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Factor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
