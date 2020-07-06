<?php

namespace backend\controllers;

use backend\models\Country;
use backend\models\Exhibitionn;
use PHPUnit\Framework\Exception;
use Yii;
use backend\models\Activity;
use backend\models\ActivitySearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ActivityController extends Controller
{
    public $enableCsrfValidation=false;
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
     * Lists all Activity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Activity model.
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

    //در view->form یه ajax نوشتم و فیلد id در id_country جدول activity رو گرفتم و به این اکشن ارسال کردم تویه این اکشن
    public function actionFindcountry()
    {
        //1- میام از جدول exhibition(نمایشگاه) هر جا که id_country اون برار آدی (id)باشه که با ajax اون رو فرستادیم و حذف نشده باشه رو برمیگردونیم
        $active = Exhibitionn::find()->where(['id_country' => $_POST['id_country']])->andWhere(['enable' => 1])->all();

        //2- حالا میایم میگیم در جدول exhibition تعداد اون فیلد هایی رو که id_country اون برار آدی (id) که با ajax اون رو فرستادیم و حذف نشده باشند رو بهمون بگو
        $count_active = Exhibitionn::find()->where(['id_country' => $_POST['id_country']])->andWhere(['enable' => 1])->count();

        //یه تابع از نوع string تعریف میکنیم که مقدار اولیه اون خالی باشه
        $find = '';
        if ($count_active >= 1) {
            $find .= '<div class="form-group field-activity-id_exhibition">';
            $find .= '<label class="control-label" for="activity-id_exhibition">نام نمایشگاه </label>';
            $find .= '<select id="activity-id_exhibition" class="form-control" name="Activity[id_exhibition]">';
            $find .= '<option value="">انتخاب کنید</option>';
            foreach ($active as $a) {
                $find .= '<option value="';
                $find .= $a->id;
                $find .= '">';
                $find .= $a->title;
                $find .= '</option>';
            }
//            $find .= '</select>';
//            $find .= '<div class="help-block"></div>';
//            $find .= '</div>';
        }//end if
        else {
            $find .= '<div class="form-group field-activity-id_exhibition">';
            $find .= '<label class="control-label" for="activity-id_exhibition">نام نمایشگاه </label>';
            $find .= '<select id="activity-id_exhibition" class="form-control" name="Activity[id_exhibition]">';
            $find .= '<option value="">نمایشگاهی وجود ندارد لطفا اول نمایشکاه را ثبت کنید.</option>';
        }//end else--
        $find .= '</select>';
        $find .= '<div class="help-block"></div>';
        $find .= '</div>';
        return ($find);
    }//end function


    /**
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new Activity();

            $country = Country::find()->where(['enable' => 1])->all();
//            $exhibition = ArrayHelper::map($country, 'id', 'country_name');
//            $exhib = [];

            if ($model->load(Yii::$app->request->post())) {

                if ($model->save()) {
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('create', [
                        'model' => $model,
                        'country' => $country,

                    ]);
                }

            }//end if $model->load
            else {
                return $this->render('create', [
                    'model' => $model,
                    'country' => $country,
                ]);
            }//end else $model->load

        }//end try
        catch (Exception $e) {
//            $transaction->rollBack();
//            Yii::$app->user->setFlash('error', "{$e->getMessage()}");
            $this->refresh();
        }//end catch

    }//end function

    /**
     * Updates an existing Activity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $country = Country::find()->where(['enable' => 1])->all();
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                if ($model->save()) {
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                else{
                    $_SESSION['error']='خطا در ذخیره سازی';
                    return $this->render('update', [
                        'model' => $model,
                        'country' => $country
                    ]);
                }

            }//end if $model->load
            else {
                return $this->render('update', [
                    'model' => $model,
                    'country' => $country
                ]);
            }//end else $model->load
        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch
    }//end function

    /**
     * Deletes an existing Activity model.
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
            if ($model->update()) {
                $transaction->commit();
                return $this->redirect(['index']);
            }//end if

        }//end try
        catch (Exception $e) {
            $this->refresh();
        }//end catch
    }//end function

    /**
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne($id)) !== null) {
            return $model;
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
