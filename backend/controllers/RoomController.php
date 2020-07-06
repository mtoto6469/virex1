<?php

namespace backend\controllers;

use backend\models\Country;
use backend\models\Exhibitionn;
use backend\models\Img;
use backend\models\Participant;
use backend\models\Profile;
use common\models\User;
use PHPUnit\Framework\Exception;
use Yii;
use backend\models\Room;
use backend\models\RoomSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RoomController implements the CRUD actions for Room model.
 */
class RoomController extends Controller
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
     * Lists all Room models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Room model.
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
            $find .= '<div class="form-group field-room-id_exhibition">';
            $find .= '<label class="control-label" for="room-id_exhibition">نام نمایشگاه </label>';
            $find .= '<select id="room-id_exhibition" class="form-control" name="Room[id_exhibition]">';
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
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new Room();
            $country = Country::find()->where(['enable' => 1])->all();
            $user = User::findOne(Yii::$app->user->getId());
            $booth = $user->id;

//            $participant = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
//            $booth = $participant->id;
//            $booth='admin';
            $images = new Img();

            if ($model->load(Yii::$app->request->post())) {
                $exhibition1 = $model->id_exhibition;
                $country1 = $model->id_country;
                $roomCount = Room::find()->where(['enable' => 1])->andWhere(['id_exhibition' => $exhibition1])->andWhere(['id_country' => $country1])->count();
                if ($roomCount > 0) {
                    $_SESSION['error'] = 'قبلا غرفه ثبت شده برای هر نمایشگاه شما باید یک غرفه ثبت کنید';
                    return $this->render('create', [
                        'model' => $model,
                        'country' => $country,
                    ]);
                }//end if $roomCount
                else {
                    $model->file = UploadedFile::getInstance($model, 'file');
                    if ($model->file != null) {
                        // echo $model->file;exit;

                        // if ($model->validate()) {


                            //با این کار در قسمت پوشه آپلود اسم عکس ها بر اساس کد کاربری که آونها رو دخیره کرده ثبت میشه و اگر دو یا چند کاربر عکسی با اسم بکسان داشته باشن هر دو عکس بر
                            //اساس کدشون هم تو پوشه آپلود هم تو دیتابیس ذهیره میشن
                            $basename = 'room' . $model->file->baseName;

                            //ذخیره در پوشه
                            $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $basename . '.' . $model->file->extension);


                            //ذخیره در دیتابیس
                            $images->filePdf = "void";
                            $images->fileMove = "void";
                            $images->uses = 'room';
                            $images->alt = 'virtual exhibition';
                            $images->enable = 1;
                            //ذخیره عکس در دیتابیس بر اساس کد کاربر
                            $images->fileImg = $basename . '.' . $model->file->extension;
                            $images->id_participant = $booth;
                            if ($images->save()) {
//                            echo $images->title;exit;
                                $im = $images->fileImg;
                            } else {
                                var_dump($images->getErrors());
                                exit();
                            }
                            $model->id_img = $im;

                            if ($model->description == "") {
                                $model->description = 'غرفه نمایشگاه';
                            }
                            $model->enable = 1;


                            if ($model->save()) {

                                $transaction->commit();
                                return $this->redirect(['view', 'id' => $model->id]);
                            } else {

                            // var_dump($model->getErrors());exit;
                                return $this->render('create', [
                                    'model' => $model,
                                    'country' => $country,
                                ]);
                            }

                        // }//end validate
                        // else {

                        // var_dump($model->getErrors());exit();
                        //     return $this->render('create', [
                        //         'model' => $model,
                        //         'country' => $country,
                        //     ]);
                        // }//end else validate
                    }//end file
                    else {
//                    echo 'file';
//                    var_dump($model->getErrors());exit();
                        return $this->render('create', [
                            'model' => $model,
                            'country' => $country,
                        ]);
                    }//end else file
                }//end else $roomCount
            }//end load

            return $this->render('create', [
                'model' => $model,
                'country' => $country,
            ]);
        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch

    }

    /**
     * Updates an existing Room model.
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
            $booth = $user->id;
            $country = Country::find()->where(['enable' => 1])->all();
            $model = $this->findModel($id);
            $images = new Img();

            if ($model->load(Yii::$app->request->post())) {

                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file != null) {
                    if ($model->validate()) {
                        $basename = 'room' . $model->file->baseName;
                        $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $basename . '.' . $model->file->extension);

                        //ذخیره در دیتابیس
                        $images->filePdf = "void";
                        $images->fileMove = "void";
                        $images->uses = 'room';
                        $images->alt = 'virtual exhibition';
                        $images->enable = 1;
                        //ذخیره عکس در دیتابیس بر اساس کد کاربر
                        $images->fileImg = $basename . '.' . $model->file->extension;
                        $images->id_participant = $booth;
                        if ($images->save()) {
//                            echo $images->title;exit;
                            $im = $images->fileImg;
                        } else {
                            var_dump($images->getErrors());
                            exit();
                        }
                        $model->id_img = $im;

                        if ($model->save()) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            return $this->render('update', [
                                'model' => $model,
                                'country' => $country,
                            ]);
                        }
                    }//end if validate
                    else {
                        return $this->render('update', [
                            'model' => $model,
                            'country' => $country,
                        ]);
                    }//end else validate
                }//end if file
                else {
                    if ($model->save()) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        return $this->render('update', [
                            'model' => $model,
                            'country' => $country,
                        ]);
                    }
                }//end else file

            }//end if load
            else {
                return $this->render('update', [
                    'model' => $model,
                    'country' => $country,
                ]);
            }//end else load
        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch

    }//end function

    /**
     * Deletes an existing Room model.
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
     * Finds the Room model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Room the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Room::findOne($id)) !== null) {
            return $model;
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
    }
}
