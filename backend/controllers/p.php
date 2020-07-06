<?php
//
//namespace backend\controllers;
//
//use backend\models\Category;
//use backend\models\Img;
//use backend\models\Participant;
//use backend\models\Productmove;
//use backend\models\Profile;
//use common\models\User;
//use PHPUnit\Framework\Exception;
//use Yii;
//use backend\models\Product;
//use backend\models\ProductSearch;
//use yii\web\Controller;
//use yii\web\NotFoundHttpException;
//use yii\filters\VerbFilter;
//use yii\web\UploadedFile;
//
///**
// * ProductController implements the CRUD actions for Product model.
// */
//class ProductController extends Controller
//{
//    public $enableCsrfValidation = false;
//
//    /**
//     * {@inheritdoc}
//     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
////                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }
//
//    /**
//     * Lists all Product models.
//     * @return mixed
//     */
//    public function actionIndex()
//    {
//        $searchModel = new ProductSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }
//
//    /**
//     * Displays a single Product model.
//     * @param integer $id
//     * @return mixed
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }
//
//    /**
//     * Creates a new Product model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     * @return mixed
//     */
//    public function actionCreate()
//    {
//        $transaction = Yii::$app->db->beginTransaction();
//        try {
//
//            $model = new Product();
////            $category = Category::find()->where(['enable' => 1])->all();
//            $user = User::findOne(Yii::$app->user->getId());
////
//            $profile1 = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
//            $participant = Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $profile1->id])->one();
//            $booth = $participant->id;
//
//            $category = Category::find()->where(['enable' => 1])->andWhere(['id_participant' => $booth])->all();
//            if ($category == null) {
//                $_SESSION['error'] = 'دhjjkjgvrfjlvtrywejuvfkfr5elfnty,hkfp.n56ujm7yi7h7ym-pmo8j7777u6t8';
//                return $this->redirect(['category/menu']);
//            } else {
//
//                $images = new Productmove();
////                $model->id_participant = $booth;
//
//                if ($model->load(Yii::$app->request->post())) {
//
//                    return $this->redirect(['view', 'id' => $model->id]);
//
////
////                    $model->fileMove1 = UploadedFile::getInstance($model, 'fileMove1');
////                    $model->fileMove2 = UploadedFile::getInstance($model, 'fileMove2');
////                    $model->fileMove3 = UploadedFile::getInstance($model, 'fileMove3');
////                    $model->fileMove4 = UploadedFile::getInstance($model, 'fileMove4');
////                    if ($model->fileMove1 != null || $model->fileMove2 != null || $model->fileMove3 != null || !$model->fileMove4 != null) {
////
////                        if ($model->validate()) {
////
////                            //
////                            //ذخیره در پوشه
////                            if ($model->fileMove1 !=null){
////                                echo 1;
////
////                                $basename1 = $booth . 'Product' . $model->fileMove1->baseName;
////                                $model->fileMove1->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename1 . '.' . $model->fileMove1->extension);
////                                $move1=$basename1 . '.' . $model->fileMove1->extension;
////                            }else{
////                                $model->fileMove1='void';
////
////                            }
////
////                            if ($model->fileMove2 !=null){
////                                echo 2;
////                                $basename2 = $booth . 'Product' . $model->fileMove2->baseName;
////                                $model->fileMove2->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename2 . '.' . $model->fileMove2->extension);
////                                $move2=$basename2 . '.' . $model->fileMove2->extension;
////
////                            }else{
////                                $model->fileMove2='void';
////
////                            }
////
////                            if ($model->fileMove3 != null){
////                                echo 3;
////                                $basename3 = $booth . 'Product' . $model->fileMove3->baseName;
////                                $model->fileMove3->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename3 . '.' . $model->fileMove3->extension);
////                                $move3=$basename3 . '.' . $model->fileMove3->extension;
////
////                            }else{
////                                $model->fileMove3='void';
////
////                            }
////
////                            if ($model->fileMove4 != null){
////
////                                $basename4 = $booth . 'Product' . $model->fileMove4->baseName;
////                                $model->fileMove4->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename4 . '.' . $model->fileMove4->extension);
////                                $move4=$basename4 . '.' . $model->fileMove4->extension;
////                            }else{
////                                $model->fileMove4='void';
////
////                            }
////
////
////                            //ذخیره در دیتابیس
////                            $images->alt = 'Advertising in virtual exhibition';
////                            $images->enable = 1;
////                            //ذخیره عکس در دیتابیس بر اساس کد کاربر
//////                            $images->move1=$basename1 .'.' .$model->fileMove1->extension;
////                            $images->move1 = $move1;
////                            $images->move2 = $move2;
////                            $images->move3 = $move3;
////                            $images->move4 = $move4;
////                            $images->id_product = -1;
////
////                            if ($images->save()) {
////                                echo 5;exit;
////                                $im = $images->id;
////                            }
////                            else {
////                                var_dump($images->getErrors());exit;
////                            }
////
////                            $model->id_img = $im;
////                            $model->id_participant = $booth;
////                            $model->enable = 1;
////                            if ($model->description == null) {
////                                $model->description = "نمایشگاه";
////                            }
////                            if ($model->shortDescription == "") {
////                                $model->shortDescription = "نمایشگاه";
////                            }
////                            if ($model->typePro == "") {
////                                $model->typePro = "void";
////                            }
////
////                            if ($model->save()) {
////
////                                $idPro=$model->id;
////                                echo $idPro;exit;
//////                                $move=Productmove::find()->all();
//////                                foreach ($move as $m){
//////                                    if ($m->id == $idPro){
//////                                        $images->id_peoduct=$idPro;
//////                                        $images->save();
//////
//////                                    }
//////                                }
//////                                $transaction->commit();
////                                return $this->redirect(['view', 'id' => $model->id]);
////
////
////                            } else {
////
////                                return $this->render('create', [
////                                    'model' => $model,
////                                    'category' => $$category,
////
////                                ]);
////                            }
////
////                        }//end if validate
////                        else {
////
////                            return $this->render('create', [
////                                'model' => $model,
////                                'category' => $category,
////
////                            ]);
////                        }//end else validate
////                    }//end if $model->file
////                    else {
////
////                        $model->id_img = 'void';
////                        $model->id_participant = $booth;
////                        $model->enable = 1;
////                        if ($model->description == null) {
////                            $model->description = "نمایشگاه";
////                        }
////                        if ($model->save()) {
//////                            $transaction->commit();
////                            return $this->redirect(['view', 'id' => $model->id]);
////
////                        } else {
////
////                            return $this->render('create', [
////                                'model' => $model,
////                                'category' => $category,
////
////                            ]);
////                        }
////                    }//end else $model->file
//
//                }//end if$model->load
//                else {
//
//
//                    return $this->render('create', [
//                        'model' => $model,
//                        'category' => $category,
//                    ]);
//
//                }
//
//            }//else $category
//
//        }//end try
//        catch (Exception $e) {
//            $transaction->rollBack();
//            $this->refresh();
//        }//end catch
//    }
//
//    /**
//     * Updates an existing Product model.
//     * If update is successful, the browser will be redirected to the 'view' page.
//     * @param integer $id
//     * @return mixed
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    public function actionUpdate($id)
//    {
//        $transaction = Yii::$app->db->beginTransaction();
//        try {
//            $model = $this->findModel($id);
//            //            $category = Category::find()->where(['enable' => 1])->all();
//            $user = User::findOne(Yii::$app->user->getId());
////            $profile=ArrayHelper::map(Product::find()->where(['enable'=>1])->andWhere(['id_user'=>$user->id])->one(),'id_user','id');
//            $profile1 = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
//            $participant = Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $profile1->id])->one();
//            $booth = $participant->id;
//            $category = Category::find()->where(['enable' => 1])->andWhere(['id_participant' => $booth])->all();
//
//            $images = new Img();
//            $model->id_participant = $booth;
//
//            if ($model->load(Yii::$app->request->post())) {
//
//                $model->file = UploadedFile::getInstance($model, 'file');
//                if ($model->file != null) {
//
//                    if ($model->validate()) {
//
//
//                        //با این کار در قسمت پوشه آپلود اسم عکس ها بر اساس کد کاربری که آونها رو دخیره کرده ثبت میشه و اگر دو یا چند کاربر عکسی با اسم بکسان داشته باشن هر دو عکس بر
//                        //اساس کدشون هم تو پوشه آپلود هم تو دیتابیس ذهیره میشن
//                        $basename = $booth . 'Pic' . $model->file->baseName;
//
//                        //ذخیره در پوشه
//                        $model->file->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $basename . '.' . $model->file->extension);
//
//
//                        //ذخیره در دیتابیس
//                        $images->address = 'upload images';
//                        $images->uses = 'booth';
//                        $images->alt = 'Advertising in virtual exhibition';
//                        $images->enable = 1;
//                        //ذخیره عکس در دیتابیس بر اساس کد کاربر
//                        $images->title = $basename . '.' . $model->file->extension;
//                        $images->id_participant = $booth;
//
//                        if ($images->save()) {
//                            $im = $images->title;
//                        }
//
//                        $model->id_img = $im;
//                        $model->id_participant = $booth;
//                        $model->enable = 1;
//                        if ($model->description == null) {
//                            $model->description = "نمایشگاه";
//                        }
//                        if ($model->shortDescription == "") {
//                            $model->shortDescription = "نمایشگاه";
//                        }
//                        if ($model->typePro == "") {
//                            $model->typePro = "void";
//                        }
//                    }//end if validate
//                    else {
//                        return $this->render('update', [
//                            'model' => $model,
//                            'category' => $category,
//                        ]);
//                    }//end validate
//                }//end if file
//                else {
//
//                    if ($model->save()) {
//                        $transaction->commit();
//                        return $this->redirect(['view', 'id' => $model->id]);
//                    } else {
//                        return $this->render('update', [
//                            'model' => $model,
//                            'category' => $category,
//                        ]);
//                    }
//                }//end else file
//
//            }//end if $model->load
//            else {
//                return $this->render('update', [
//                    'model' => $model,
//                    'category' => $category,
//                ]);
//            }//end else load
//        }//end try
//        catch (Exception $e) {
//            $transaction->rollBack();
//            $this->refresh();
//        }//end catch
//    }
//
//    /**
//     * Deletes an existing Product model.
//     * If deletion is successful, the browser will be redirected to the 'index' page.
//     * @param integer $id
//     * @return mixed
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    public function actionDelete($id)
//    {
//        $transaction = Yii::$app->db->beginTransaction();
//        try {
//            $model = $this->findModel($id);
//            $model->enable = 0;
//            if ($model->save()) {
//                $transaction->commit();
//                return $this->redirect(['index']);
//            } else {
//                return $this->redirect(['index']);
//            }
//        }//end try
//        catch (Exception $e) {
//            $transaction->rollBack();
//            $this->refresh();
//        }//end catch
//    }
//
//    /**
//     * Finds the Product model based on its primary key value.
//     * If the model is not found, a 404 HTTP exception will be thrown.
//     * @param integer $id
//     * @return Product the loaded model
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    protected function findModel($id)
//    {
//        if (($model = Product::findOne($id)) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//    }
//}


///////////////////////////////////////////////////////////////////////////////////////////


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
