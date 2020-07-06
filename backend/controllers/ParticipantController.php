<?php

namespace backend\controllers;

use backend\models\Activity;
use backend\models\Country;
use backend\models\Exhibitionn;
use backend\models\Img;
use backend\models\Imgupload;
use backend\models\Profile;
use backend\models\Room;
use common\models\User;
use PHPUnit\Framework\Exception;
use Yii;
use backend\models\Participant;
use backend\models\ParticipantSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ParticipantController implements the CRUD actions for Participant model.
 */
class ParticipantController extends Controller
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
     * Lists all Participant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Participant model.
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

    /***********************************************************************/
    public function actionFindcountry()
    {
        //1- میام از جدول exhibition(نمایشگاه) هر جا که id_country اون برار آدی (id)باشه که با ajax اون رو فرستادیم و حذف نشده باشه رو برمیگردونیم
        $active = Exhibitionn::find()->where(['id_country' => $_POST['id_country']])->andWhere(['enable' => 1])->all();

        //2- حالا میایم میگیم در جدول exhibition تعداد اون فیلد هایی رو که id_country اون برار آدی (id) که با ajax اون رو فرستادیم و حذف نشده باشند رو بهمون بگو
        $count_active = Exhibitionn::find()->where(['id_country' => $_POST['id_country']])->andWhere(['enable' => 1])->count();

        //یه تابع از نوع string تعریف میکنیم که مقدار اولیه اون خالی باشه
        $find = '';
        if ($count_active >= 1) {
            $find .= '<div class="form-group field-activity-id_exhibition exhibitionName">';
            $find .= '<label class="control-label" for="activity-id_exhibition">نام نمایشگاه </label>';
            $find .= '<select id="participant-id_exhibition" class="form-control" name="Participant[id_exhibitionn]"  onchange="Myexhibition(this.value)">';
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
            $find .= '<select id="participant-id_exhibition" class="form-control" name="Participant[id_exhibitionn]">';
            $find .= '<option value="">نمایشگاهی وجود ندارد لطفا اول نمایشکاه را ثبت کنید.</option>';
        }//end else--
        $find .= '</select>';
        $find .= '<div class="help-block"></div>';
        $find .= '</div>';
        return ($find);
    }//end function
    /***********************************************************************/
    /***********************************************************************/
//    public function actionFindexhibition()
//    {
//        //1- میام از جدول exhibition(نمایشگاه) هر جا که id_country اون برار آدی (id)باشه که با ajax اون رو فرستادیم و حذف نشده باشه رو برمیگردونیم
//        $active = Room::find()->where(['id_exhibition' => $_POST['id_exhibition']])->andWhere(['enable' => 1])->all();
//
//        //2- حالا میایم میگیم در جدول exhibition تعداد اون فیلد هایی رو که id_country اون برار آدی (id) که با ajax اون رو فرستادیم و حذف نشده باشند رو بهمون بگو
//        $count_active = Room::find()->where(['id_exhibition' => $_POST['id_exhibition']])->andWhere(['enable' => 1])->count();
//
//        //یه تابع از نوع string تعریف میکنیم که مقدار اولیه اون خالی باشه
//        $find = '';
//        if ($count_active >= 1) {
//            $find .= '<div class="form-group field-activity-id_exhibition activityName">';
//            $find .= '<label class="control-label" for="activity-id_exhibition">نام غرفه </label>';
//            $find .= '<select id="participant-id_activity" class="form-control" name="Participant[id_exhibition]" aria-required="true" onclick="Myactivity(this.value)">';
//            $find .= '<option value="">انتخاب کنید</option>';
//            foreach ($active as $a) {
//                $find .= '<option value="';
//                $find .= $a->id;
//                $find .= '">';
//                $find .= $a->id;
//                $find .= '</option>';
//            }
////            $find .= '</select>';
////            $find .= '<div class="help-block"></div>';
////            $find .= '</div>';
//        }//end if
//        else {
//            $find .= '<div class="form-group field-activity-id_exhibition">';
//            $find .= '<label class="control-label" for="activity-id_exhibition">نام غرفه </label>';
//            $find .= '<select id="activity-id_exhibition" class="form-control" name="Activity[id_exhibition]">';
//            $find .= '<option value="">غرفه ای وجود ندارد لطفا اول غرفه را ثبت کنید.</option>';
//        }//end else--
//        $find .= '</select>';
//        $find .= '<div class="help-block"></div>';
//        $find .= '</div>';
//        return ($find);
//    }
    /***********************************************************************/
    /***********************************************************************/
    public function actionFindexhibition()
    {
        $active = Room::find()->where(['id_exhibition' => $_POST['id_exhibition']])->andWhere(['enable' => 1])->all();
        foreach ($active as $a){
//            echo $a->id;exit;
        }
        $count_active = Room::find()->where(['id_exhibition' => $_POST['id_exhibition']])->andWhere(['enable' => 1])->count();
        $active1 = Activity::find()->where(['id_exhibition' => $_POST['id_exhibition']])->andWhere(['enable' => 1])->all();
        foreach ($active1 as $a){
//            echo $a->activity;exit;
        }
        $count_active1 = Activity::find()->where(['id_exhibition' => $_POST['id_exhibition']])->andWhere(['enable' => 1])->count();

        //یه تابع از نوع string تعریف میکنیم که مقدار اولیه اون خالی باشه
        $find = '';
        if ($count_active >= 1) {
            $find .= '<div class="form-group field-activity-id_exhibition activityName">';
            $find .= '<label class="control-label" for="activity-id_exhibition">کد غرفه </label>';
            $find .= '<select id="participant-id_activity" class="form-control" name="Participant[id_room]" aria-required="true" onclick="Myactivity(this.value)">';
            $find .= '<option value="">انتخاب کنید</option>';
            foreach ($active as $a) {
                $find .= '<option value="';
                $find .= $a->id;
                $find .= '">';
                $find .= $a->id;
                $find .= '</option>';
            }
//            $find .= '</select>';
//            $find .= '<div class="help-block"></div>';
//            $find .= '</div>';
        }//end if
        else {
            $find .= '<div class="form-group field-activity-id_exhibition">';
            $find .= '<label class="control-label" for="activity-id_exhibition">نام غرفه </label>';
            $find .= '<select id="activity-id_exhibition" class="form-control" name="Activity[id_room]">';
            $find .= '<option value="">غرفه ای وجود ندارد لطفا اول غرفه را ثبت کنید.</option>';
        }//end else--
        $find .= '</select>';
        $find .= '<div class="help-block"></div>';
        $find .= '</div>';
        $ac = '';
        $ac .= '<div class="form-group field-activity-id_exhibition activityName">';
        $ac .= '<label class="control-label" for="activity-id_exhibition">زمینه فعالیت  </label>';
        if ($count_active1 >= 1) {

            foreach ($active1 as $act) {


                $ac .= '<div class="col-md-4" id="checkboxlist">';
                $ac .= '<input style="margin: 10px" id="participant-id_activity1" title="" name="Participant[id_activity]" value="';
                $ac .= $act->id;
                $ac .= '" type="checkbox" >';
                $ac .= $act->activity;
                $ac .= '</div>';

            }

        }//end if
        else {
            $ac .= '<div class="col-md-4" id="checkboxlist">';
//            $ac .= '<input style="margin: 10px" id="participant-id_activity1" title="" name="Participant[id_activity]" value="">هیچ فعالیتی ثبت نشده ';
        }
//        echo $ac;exit;

//        var_dump($find);

        return ($find . $ac);


    }
    /***********************************************************************/
    /***********************************************************************/
//    public function actionFindteaser()
//
//    {
////        echo $_POST['id_teaser'];exit;
//        $find = '';
//        if ($_POST['id_teaser'] == 1) {
////            echo 5;exit;
//            $find .= '<div class="form-group field-participant-file2">';
//            $find .= '<<label class="control-label" for="participant-file2">تیرز تبلیغاتی شرکت</label>';
//            $find .= '<input name="Participant[file2]" value="" type="hidden">';
//            $find .= '<input id="participant-file2" name="Participant[file2]" type="file">';
//            $find .= '<div class="help-block"></div>';
//            $find .= '</div>';
//            return ($find);
//
//        } else {
//            echo 'تیزر تبلیغاتی';
//            exit;
//        }
//    }//end function

    /***********************************************************************/
    /**
     * Creates a new Participant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $user = User::findOne(Yii::$app->user->getId());
            $profile = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
            $pro = $profile->id;
            $country = Country::find()->where(['enable' => 1])->all();
            $country1 = ArrayHelper::map(Country::find()->where(['enable' => 1])->all(), 'country_name', 'id');

            $ex = ArrayHelper::map(Exhibitionn::find()->where(['enable' => 1])->andWhere(['id_country' => $country1])->all(), 'title', 'id');
            $activity = ArrayHelper::map(Activity::find()->where(['id_country' => $country1])->andWhere(['id_exhibition' => $ex])->all(), 'id', 'activity');
            $model = new Participant();

            $images = new Img();

            if ($model->load(Yii::$app->request->post())) {
//                var_dump($model->id_activity);exit;
//                echo $model->id_room;exit;

//                var_dump(count($model->id_activity));exit;

                $model->file = UploadedFile::getInstance($model, 'file');
                $model->file1 = UploadedFile::getInstance($model, 'file1');
                $model->file2 = UploadedFile::getInstance($model, 'file2');

                if ($model->validate()) {


                    if ($model->file != null || $model->file1 != null || $model->file2 != null) {

                        if ($model->file != null) {
                            $basename = $pro . 'Pic' . $model->file->baseName;
                            $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $basename . '.' . $model->file->extension);

                        } else {
//                        var_dump($model->getErrors());exit;
                            $model->file = 'void';
                        }
                        if ($model->file1 != null) {
                            $basename1 = $pro . 'Pic' . $model->file1->baseName;
                            $model->file1->saveAs(Yii::getAlias('@upload') . '/upload/files/' . $basename1 . '.' . $model->file1->extension);

                        } else {
//                        var_dump($model->getErrors());exit;
                            $model->file1 = 'void';
                        }
                        if ($model->file2 != null) {
                            $basename2 = $pro . 'Pic' . $model->file2->baseName;
                            $model->file2->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename2 . '.' . $model->file2->extension);


                        } else {

                            $model->file2 = 'void';
                        }

                        $images->uses = 'booth';
                        $images->alt = 'Advertising in virtual exhibition';
                        $images->enable = 1;
//                        //ذخیره عکس در دیتابیس بر اساس کد کاربر
                        $images->fileImg = $basename . '.' . $model->file->extension;
                        $images->filePdf = $basename1 . '.' . $model->file1->extension;
                        $images->fileMove = $basename2 . '.' . $model->file2->extension;
                        $images->id_participant = $pro;

                        if ($images->save()) {
                            
                            $im = $images->id;
//                            echo $im;
                        }else {
                            echo 'error not save picture';exit;
                        }

                        $exhibit = Exhibitionn::find()->where(['id_country' => $model->id_country])->andWhere(['id_exhibition' => $model->id_exhibitionn]);
                        $model->id_company = $pro;
                        $model->id_images = $im;
//                        echo $model->id_exhibitionn;
//                        echo $model->id_activity;exit;
                        if ($model->save()) {
//                            echo $model->id;exit;
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
//                            return $this->redirect(['buy', 'id' => $model->id]);
                        } else {
//                            var_dump($model->getErrors());exit;
                            $_SESSION['error']='خطا در ذخیره سازی اطلاعات';
                            return $this->render('create', [
                                'model' => $model,
                                'country' => $country,
                                'activity' => $activity,
                                'exhibit' => $exhibit,
                            ]);
                        }

                    } else {
                       
                        $exhibit = Exhibitionn::find()->where(['id_country' => $model->id_country])->andWhere(['id_exhibition' => $model->id_exhibitionn]);
                        $model->id_company = $pro;
                        $model->id_images = -1;
//                        echo $model->id_exhibitionn;
//                        echo $model->id_activity;exit;
                        if ($model->save()) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            $_SESSION['error']='خطا در ذخیره سازی اطلاعات';
                            return $this->render('create', [
                                'model' => $model,
                                'country' => $country,
                                'activity' => $activity,
                                'exhibit' => $exhibit,
                            ]);
                        }
                    }



                }//end if validate
                else {
                    $_SESSION['error']='اطلاعات validate نشده اند';
                    return $this->render('create', [
                        'model' => $model,
                        'country' => $country,
                        'activity' => $activity,
                    ]);
                }//end else validate

            }//end if load
            else {
                return $this->render('create', [
                    'model' => $model,
                    'country' => $country,
                    'activity' => $activity,
                ]);
            }//end else load

        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch

    }

    /**
     * Updates an existing Participant model.
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
            $profile = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
            $pro = $profile->id;

            $images = Img::find()->where(['enable' => 1])->andWhere(['id_participant' => $pro])->all();
            foreach ($images as $im) {
                $fileImg = $im->fileImg;
                $filePdf = $im->filePdf;
                $fileMove = $im->fileMove;
                $id_participant = $im->id_participant;
            }
            $img=Img::find()->where(['enable'=>1])->andWhere(['id'=>$id])->one();

            $country = Country::find()->where(['enable' => 1])->all();
            $country1 = ArrayHelper::map(Country::find()->where(['enable' => 1])->all(), 'country_name', 'id');

            $ex = ArrayHelper::map(Exhibitionn::find()->where(['enable' => 1])->andWhere(['id_country' => $country1])->all(), 'title', 'id');
            $activity = Activity::find()->where(['id_country' => $country1])->andWhere(['id_exhibition' => $ex])->all();
            $model = $this->findModel($id);

            $images1 = new Img();

            if ($model->load(Yii::$app->request->post())) {

                //زمانی که عکس جدید آپلود میکنیم
                $model->file = UploadedFile::getInstance($model, 'file');
                $model->file1 = UploadedFile::getInstance($model, 'file1');
                $model->file2 = UploadedFile::getInstance($model, 'file2');

                if ($model->file != null) {


                    if ($model->file != $fileImg) {

                        $basename = $pro . 'Pic' . $model->file->baseName;
                        $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $basename . '.' . $model->file->extension);
                        $images1->fileImg = $basename . '.' . $model->file->extension;
                        $image = $images1->fileImg;

                    }
                } else {

                    $image = $images1->fileImg = $fileImg;
                }

                if ($model->file1 != null) {

                    if ($model->file1 != $filePdf) {
                        $basename = $pro . 'Pic' . $model->file1->baseName;
                        $model->file1->saveAs(Yii::getAlias('@upload') . '/upload/files/' . $basename . '.' . $model->file1->extension);
                        $images1->filePdf = $basename . '.' . $model->file1->extension;
                        $pdf = $images1->filePdf;
                    }
                } else {

                    $pdf = $images1->filePdf = $filePdf;
                }

                if ($model->file2 != null) {

                    if ($model->file2 != $fileMove) {
                        $basename = $pro . 'Pic' . $model->file2->baseName;
                        $model->file2->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename . '.' . $model->file2->extension);
                        $images1->fileMove = $basename . '.' . $model->file2->extension;
                        $move = $images1->fileMove;
                    }
                } else {

                    $move = $images1->fileMove = $fileMove;
                }
                $images1->fileImg = $image;
                $images1->filePdf = $pdf;
                $images1->fileMove = $move;
                $images1->uses = "booth";
                $images1->alt = "virtual exhibition";
                $images1->enable = 1;
                $images1->id_participant = $id_participant;

                if ($images1->save()) {
                    $id_img = $images1->id;
                }

                $model->id_images = $id_img;
                $model->id_company = $pro;

                if ($model->save()) {
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                        'country' => $country,
                        'activity' => $activity,
                        'images' => $images,
                    ]);
                }

//                $model->id_company = $pro;
//
//                if ($model->save()) {
//                    $transaction->commit();
//                    return $this->redirect(['view', 'id' => $model->id]);
//                } else {
//                    return $this->render('update', [
//                        'model' => $model,
//                        'country' => $country,
//                        'activity' => $activity,
//                        'images' => $images,
//                    ]);
//                }
            }//end if load
            else {
                return $this->render('update', [
                    'model' => $model,
                    'country' => $country,
                    'activity' => $activity,
                    'images' => $images,
                    'img'=>$img,
                ]);
            }
        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch
    }

    /**
     * Deletes an existing Participant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = $this->findModel($id);
            $model->enable = 1;
            if ($model->save()) {
                $transaction->commit();
                return $this->redirect(['index']);
            }
        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch
    }

    /**
     * Finds the Participant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Participant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Participant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
