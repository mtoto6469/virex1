<?php

namespace backend\controllers;

use backend\models\Img;
use backend\models\Participant;
use backend\models\Product;
use backend\models\Profile;
use common\models\User;
use PHPUnit\Framework\Exception;
use Yii;
use backend\models\Category;
use backend\models\CategorySearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new Category();

            $category = Category::find()->where(['enable' => 1])->all();
            $user = User::findOne(Yii::$app->user->getId());
//            $profile=ArrayHelper::map(Product::find()->where(['enable'=>1])->andWhere(['id_user'=>$user->id])->one(),'id_user','id');
            $profile1 = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
            $participant = Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $profile1->id])->one();
            $booth = $participant->id;

            //برای ذخیره عکس
            $images = new Img();
            if ($model->load(Yii::$app->request->post())) {

                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file != null) {


                    if ($model->validate()) {
                          $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $model->file->baseName . '.' . $model->file->extension);
                        //با این کار در قسمت پوشه آپلود اسم عکس ها بر اساس کد کاربری که آونها رو دخیره کرده ثبت میشه و اگر دو یا چند کاربر عکسی با اسم بکسان داشته باشن هر دو عکس بر
                        //اساس کدشون هم تو پوشه آپلود هم تو دیتابیس ذهیره میشن
                        // $basename = $booth . 'Pic' . $model->file->baseName;

                        //ذخیره در پوشه
                        // $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $basename . '.' . $model->file->extension);


                        //ذخیره در دیتابیس
                        $images->fileMove="void";
                        $images->filePdf="void";
                        $images->uses = 'booth';
                        $images->alt = 'Advertising in virtual exhibition';
                        $images->enable = 1;
                        //ذخیره عکس در دیتابیس بر اساس کد کاربر
                        $images->fileImg = $basename . '.' . $model->file->extension;
                        $images->id_participant = $booth;//کد غرفه دار

                        if ($images->save()) {
//                            var_dump($images->id);exit;
                            $im = $images->id;
                        } else {
                            var_dump($images->getErrors());
                            exit;
                        }

                        //ذخیره کردن اطلاهات در جدول category

                        if ($model->id_parent == null) {
                            $model->id_parent = 0;
                        } elseif ($model->id_parent == 0) {
                            $model->id_parent = 0;
                        }
                        $model->description='نمایشگاه مجازی vireex';
                        $model->id_participant = $booth;
                        $model->id_img = $im;
                        $model->enable = 1;


                        if ($model->save()) {

                            $transaction->commit();
                            $_SESSION['error']='رکورد ثبت شد';
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
//var_dump($model->getErrors());exit;
                            $_SESSION['error']='خطا! در ذخیره سازی';
                            return $this->render('create', [
                                'model' => $model,
                                'category' => $category,
                                'booth' => $booth,
                            ]);
                        }

                    }//if validate
                    else {
                        $_SESSION['error']='خطا! در ثبت عکس';
                        return $this->render('create', [
                            'model' => $model,
                            'category' => $category,
                            'booth' => $booth,
                        ]);
                    }//else validate
                }//if $model->file
                else {
                    
                    $_SESSION['error']='لطفا یک عکس آپلود کنید';
                    return $this->render('create', [
                        'model' => $model,
                        'category' => $category,
                        'booth' => $booth,
                    ]);
                    
//                    if ($model->id_parent == null) {
//                        $model->id_parent = 0;
//                    }
//                    if ($model->id_parent == null) {
//                        $model->id_parent = 0;
//                    } elseif ($model->id_parent == 0) {
//                        $model->id_parent = 0;
//                    }
//                    $model->id_participant = $booth;
//                    $model->id_img = -1;
//                    $model->enable = 1;
//
//                    if ($model->save()) {
//
//                        $transaction->commit();
//                        return $this->redirect(['view', 'id' => $model->id]);
//                    } else {
//
//                        return $this->render('create', [
//                            'model' => $model,
//                            'category' => $category,
//                            'booth' => $booth,
//                        ]);
//                    }

                }//else $model->file


            }//end if $model->load

            else {
                return $this->render('create', [
                    'model' => $model,
                    'category' => $category,
                    'booth' => $booth,
                ]);
            }//else $model->load

        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = $this->findModel($id);

            $user = User::findOne(Yii::$app->user->getId());
            $profile1 = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
            $participant = Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $profile1->id])->one();
            $booth = $participant->id;

            $category = Category::find()->where(['enable' => 1])->andWhere(['id_participant' => $booth])->all();
            $img=Img::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_img])->one();
            $images = new Img();

            if ($model->load(Yii::$app->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file != null) {

                    if ($model->validate()) {

//                        //با این کار در قسمت پوشه آپلود اسم عکس ها بر اساس کد کاربری که آونها رو دخیره کرده ثبت میشه و اگر دو یا چند کاربر عکسی با اسم بکسان داشته باشن هر دو عکس بر
//                        //اساس کدشون هم تو پوشه آپلود هم تو دیتابیس ذهیره میشن
                        $basename = $booth . 'Pic' . $model->file->baseName;
//
//                        //ذخیره در پوشه
                        $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $basename . '.' . $model->file->extension);


//                        //ذخیره در دیتابیس
                        $images->fileMove="void";
                        $images->filePdf="void";
                        $images->uses = 'booth';
                        $images->alt = 'Advertising in virtual exhibition';
                        $images->enable = 1;
//                        //ذخیره عکس در دیتابیس بر اساس کد کاربر
                        $images->fileImg = $basename . '.' . $model->file->extension;
                        $images->id_participant = $booth;

                        if ($images->save()) {
                            $im = $images->id;
                        }
                        $model->id_img = $im;

                        if ($model->save()) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            return $this->render('update', [
                                'model' => $model,
                                'category' => $category,
                            ]);
                        }
                    }//if $model->validate
                    else {
                        return $this->render('update', [
                            'model' => $model,
                            'category' => $category,
                        ]);
                    }//else $model->validate
                }//end $model->file
                else {

                    if ($model->save()) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        return $this->render('update', [
                            'model' => $model,
                            'category' => $category,
                        ]);
                    }
                }
            }//end if $model->post
            else {
                return $this->render('update', [
                    'model' => $model,
                    'category' => $category,
                    'img'=>$img,
                ]);
            }//end if $model->file

        }//end try
        catch
        (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//چون زیر دسته هارو برای app حذف کردم نیاز به این قسمت Deletall نیست
//    protected function Deletall($id_parent)
//    {
//        $category = Category::find()->where(['id_parent' => $id_parent])->all();
//        foreach ($category as $cat) {
//            $product = Product::find()->where(['id_category' => $cat])->all();
//            foreach ($product as $pro) {
//                $pro->enable = 0;
//                $pro->save();
//            }
//            $cat->enable = 0;
//            $cat->save();
//            $this->Deletall($cat->id);
//
//        }
//    }


    public function actionDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = $this->findModel($id);

//            $this->Deletall($id);
//            $pro = Product::find()->where(['id_category' => $model->id])->all();
//            foreach ($pro as $p) {
//                $p->enable = 0;
//                $p->save();
//            }
            
            //first delete all products these category
            $product=Product::find()->where(['enable'=>1])->andWhere(['id_category'=>$model->id])->all();
            if ($product){
                foreach ($product as $p){
                    $p->enable=0;
                    $p->save();
                }//end foreach product
            }
            
            //second delete category
            $model->enable = 0;
            if ($model->save()) {
                $transaction->commit();
                $_SESSION['error']='رکورد حذف شد';
                return $this->redirect(['index']);
            }
            else{
//                var_dump($model->getErrors());exit;
                $_SESSION['error']='خطا! رکورد مورد نظر حذف نشد';
                return $this->redirect(['index']);
            }
        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch

    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
