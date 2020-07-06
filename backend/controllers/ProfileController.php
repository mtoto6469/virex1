<?php

namespace backend\controllers;

use backend\models\Img;
use PHPUnit\Framework\Exception;
use Yii;
use backend\models\Profile;
use backend\models\ProfileSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\components\jdf;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
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
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
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
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new Profile();
            $image = new Img();
            $pic = Img::find()->where(['enable' => 1])->andWhere(['alt' => 'users image'])->one();
            $img = $pic->id;

            $role = ['admin' => 'مدیر کل', 'booth' => 'غرفه دار', 'writer' => 'منشی', 'user' => 'کاربر'];


            if ($model->load(Yii::$app->request->post())) {

                $model->file = UploadedFile::getInstance($model, 'file');


                if ($model->file != null) {
                    //باید اول عکس رو در گالری ذخیره کنیم
                    if ($model->validate()) {
                        //ذخیره عکس در گالری
                        $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $model->file->baseName . '.' . $model->file->extension);

                        //ذخیره عکس در دیتابیس
                        $image->title = $model->file->baseName . '.' . $model->file->extension;
                        $image->address = 'upload/images';
                        $image->alt = $model->name;
                        $image->id_participant = -1;
//                        $image->uses = Yii::$app->user->getId();
                        $image->uses = 'void';
                        $image->enable = 1;
                        if ($image->save()) {
                            $img1 = $image->id;
                        } else {
                        }

                        //ذخیره بقیه اطلاعات در جدول profile

                        $model->id_img = $img1;
                        $model->company_name_en = 'void';
                        $model->company_name_ir = 'void';
                        $date_ir = new jdf();
                        $model->date = date('Y/m/d');
                        $model->date_ir = $date_ir->date('Y/m/d');
                        $model->date_update = '2018/08/11';
                        $model->date_update_ir = $date_ir->date('Y/m/d');
                        $model->state = 0;
                        $model->rules = 1;
                        $model->code = '0000000000000000';
                        $model->enable = 1;
                        if ($model->save()) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {

//                        var_dump($model->getErrors());exit();

                            return $this->render('create', [
                                'model' => $model,
                                'image' => $image,
                                'role' => $role,
                            ]);
                        }
                    }
                    return $this->render('create', [
                        'model' => $model,
                        'image' => $image,
                        'role' => $role,
                    ]);
                } else {    //در صرتی که هیچ عکسی آپلود نشود
                    $model->id_img = $img;
                    $model->company_name_en = 'void';
                    $model->company_name_ir = 'void';
                    $date_ir = new jdf();
                    $model->date = date('Y/m/d');
                    $model->date_ir = $date_ir->date('Y/m/d');
                    $model->date_update = '2018/08/11';
                    $model->date_update_ir = $date_ir->date('Y/m/d');
                    $model->state = 0;
                    $model->rules = 1;
                    $model->code = '0000000000000000';
                    $model->enable = 1;
                    if ($model->save()) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $_SESSION['error'] = 'کاربر ثبت نشد';
                        return $this->render('create', [
                            'model' => $model,
                            'image' => $image,
                            'role' => $role,
                        ]);
                    }
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'image' => $image,
                    'role' => $role
                ]);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::$app->user->setFlash('error', "{$e->getMessage()}");
            $this->refresh();
        }
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $transaction = yii::$app->db->beginTransaction();
        try {
            $model = $this->findModel($id);
            $image = new Img();
            $profile = Profile::find()->where(['enable' => 1])->all();
            $role = ['admin' => 'مدیر کل', 'booth' => 'غرفه دار', 'writer' => 'منشی', 'user' => 'کاربر'];

            if ($model->load(Yii::$app->request->post())) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
                'profile' => $profile,
                'role' => $role,
            ]);
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::$app->user->setFlash('error', "{$e->getMessage()}");
            $this->refresh();
        }
    }

    /**
     * Deletes an existing Profile model.
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
                return $this->redirect(['index']);
            } else {
                return $this->redirect(['index']);
            }

        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch

    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
