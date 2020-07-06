<?php

namespace backend\controllers;

use backend\models\Category;
use backend\models\Participant;
use backend\models\Profile;
use common\models\User;
//use frontend\models\Productmove;
use PHPUnit\Framework\Exception;
use Yii;
use backend\models\Product;
use backend\models\Productmove;
use backend\models\ProductSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new Product();
//            $category = ArrayHelper::map(Category::find()->where(['enable' => 1])->all(),'id','title');
            $category = Category::find()->where(['enable' => 1])->all();
            $user = User::findOne(Yii::$app->user->getId());
//
            $profile1 = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
            $participant = Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $profile1->id])->one();
            $booth = $participant->id;

            $category = Category::find()->where(['enable' => 1])->andWhere(['id_participant' => $booth])->all();
            if ($category == null) {
                $_SESSION['error'] = 'دhjjkjgvrfjlvtrywejuvfkfr5elfnty,hkfp.n56ujm7yi7h7ym-pmo8j7777u6t8';
                return $this->redirect(['category/menu']);
            } else {

                $images = new Productmove();
//                $model->id_participant = $booth;

                if ($model->load(Yii::$app->request->post())) {


                    if ($model->id_Category != null && $model->id_Category != 0 && $model->id_Category != -1){
//                    if ( $model->id_Category != 0) {
//
                        $model->fileMove1 = UploadedFile::getInstances($model, 'fileMove1');
                        $model->fileMove2 = UploadedFile::getInstance($model, 'fileMove2');
                        $model->fileMove3 = UploadedFile::getInstance($model, 'fileMove3');

                        if ($model->fileMove3 != null && $model->fileMove1 !=null ) {

                            if ($model->validate()) {


                                //
                                //ذخیره در پوشه
                                if ($model->fileMove1 != null) {

                                    $movies = '-**-';
                                    foreach ($model->fileMove1 as $movie) {

                                        $nModel = new Productmove();
                                        $basename1 = $booth . 'Product' . $movie->baseName;
//                                        $b=$booth . 'Product' ;
                                        $movie->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename1 . '.' . $movie->extension);
                                        $move1 = $basename1 . '.' . $movie->extension;
//                                        $movie->saveAs(Yii::getAlias('@upload').'/upload/video/'.$basename1.'.'.$model->fileMove1[]->extension);
//                                        $move1=$basename1.'.'.$model->fileMove1[]->extension;
                                        $movies = $movies . $move1 . '-**-';
                                    }

//var_dump($nModel->move1=$movies);exit;
//                                    $basename1 = $booth . 'Product' . $model->fileMove1->baseName;
//                                    $model->fileMove1->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename1 . '.' . $model->fileMove1->extension);
//                                    $move1 = $basename1 . '.' . $model->fileMove1->extension;
                                } else {

                                    $movies = $model->fileMove1 = 'void';

                                }

                                if ($model->fileMove2 != null) {


                                    $basename2 = $booth . 'Product' . $model->fileMove2->baseName;
                                    $model->fileMove2->saveAs(Yii::getAlias('@upload') . '/upload/files/' . $basename2 . '.' . $model->fileMove2->extension);
                                    $move2 = $basename2 . '.' . $model->fileMove2->extension;

                                } else {

                                    $move2 = $model->fileMove2 = 'void';

                                }

                                if ($model->fileMove3 != null) {

                                    $basename3 = $booth . 'Product' . $model->fileMove3->baseName;
                                    $model->fileMove3->saveAs(Yii::getAlias('@upload') . '/upload/images/' . $basename3 . '.' . $model->fileMove3->extension);
                                    $move3 = $basename3 . '.' . $model->fileMove3->extension;

                                } else {

                                    $move3 = $model->fileMove3 = 'void';

                                }
//
//                                if ($model->fileMove4 != null) {
//
//                                    $basename4 = $booth . 'Product' . $model->fileMove4->baseName;
//                                    $model->fileMove4->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename4 . '.' . $model->fileMove4->extension);
//                                    $move4 = $basename4 . '.' . $model->fileMove4->extension;
//                                } else {
////                                echo 44;exit;
//                                    $move4 = $model->fileMove4 = 'void';
//
//
//                                }
//                                var_dump($movies);
//                                var_dump($move2);
//                                var_dump($move3);exit;

                                //ذخیره در دیتابیس
                                if ($movies=='void'){

                                    $images->alt = 'Advertising in virtual exhibition';
                                    $images->enable=1;
                                    $images->move1=$movies;
                                    $images->move2=$move2;
                                    $images->move3=$move3;
                                    $images->move4='void';
                                    $images->id_product=-1;
                                    if ($images->save()){
                                        $im=$images->id;
                                    }
                                    else{
                                        var_dump($images->getErrors());exit;
                                    }

                                }else{

                                    $img = $images->alt = 'Advertising in virtual exhibition';
                                    $nModel->alt = $img;

                                    $nModel->enable = $images->enable = 1;
                                    //ذخیره عکس در دیتابیس بر اساس کد کاربر
//                            $images->move1=$basename1 .'.' .$model->fileMove1->extension;
                                    $m = $images->move1 = $movies;
                                    $nModel->move1 = $m;
//                                $nModel->move1 = $movies;

                                    $idP = $images->id_product = -1;
                                    $nModel->id_product = $idP;

                                    $nModel->move2 = $move2;
                                    $nModel->move3 = $move3;


//اگر هر چهار عکس void بود در جدول productMove  ذخیره نشود
                                    if ((($movies == $move2) && ($move2 == $move3)) != 'void') {
//                                    echo $move1;
//                                    echo $move2;
//                                    echo $move3;
//                                    echo $move4;

                                        if ($nModel->save()) {

                                            $im = $nModel->id;

                                        } else {
                                            var_dump($nModel->getErrors());
                                            exit;
                                        }
                                    }//end if !=void
                                    else {

                                        $im = -1;
                                    }

                                }//end else movies != void


                                $model->id_img = $im;
//                                echo $model->id_img;exit;
                                $model->id_participant = $booth;
                                $model->enable = 1;
                                if ($model->description == null) {
                                    $model->description = "نمایشگاه";
                                }
                                if ($model->shortDescription == "") {
                                    $model->shortDescription = "نمایشگاه";
                                }
                                if ($model->typePro == "") {
                                    $model->typePro = "void";
                                }


                                if ($model->save()) {

                                    $idPro = $model->id;


//اگر در جدول productMove فیلم محصول ثبت شده باشد
                                    if ($model->id_img != -1) {


                                        $move = Productmove::find()->where(['id' => $model->id_img])->one();
                                        if ($move) {
                                            $move->id_product = $idPro;
                                            $nModel->id_product = $move->id_product;

                                            if ($nModel->save()) {

                                            }//end if $nModel save
                                            else {

                                            }//end else #nModel save
                                        }//end if $move
                                    }//end if $model->id_img != -1
                                    else {

                                    }//end else $model->id_img == -1

                                    $transaction->commit();
                                    return $this->redirect(['view', 'id' => $model->id]);


                                } else {

                                    var_dump($model->getErrors());
                                    exit;
                                    return $this->render('create', [
                                        'model' => $model,
                                        'category' => $category,

                                    ]);
                                }


                            }//end if validate
                            else {

                                return $this->render('create', [
                                    'model' => $model,
                                    'category' => $category,

                                ]);
                            }//end else validate

                        }//end if $model->file

                        else {
                            $_SESSION['error'] = 'عکس و فیلم محصول اجباری میباشد';
                            return $this->render('create', [
                                'model' => $model,
                                'category' => $category,

                            ]);

//                            $model->id_img = -1;
//                            $model->id_participant = $booth;
//                            $model->enable = 1;
//                            if ($model->description == null) {
//                                $model->description = "نمایشگاه";
//                            }
//                            if ($model->save()) {
////                            $transaction->commit();
//                                return $this->redirect(['view', 'id' => $model->id]);
//
//                            } else {
//
//                                return $this->render('create', [
//                                    'model' => $model,
//                                    'category' => $category,
//
//                                ]);
//                            }
                        }//end else $model->file

                    } else {
                        $_SESSION['error'] = 'لطفا اول دسته مورد نظر را انتخاب کنید';
                        return $this->render('create', [
                            'model' => $model,
                            'category' => $category,

                        ]);
                    }

                }//end if$model->load
                else {


                    return $this->render('create', [
                        'model' => $model,
                        'category' => $category,
                    ]);

                }

            }//else $category

        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch


//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
    }

    /**
     * Updates an existing Product model.
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
            $participant = Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $profile->id])->one();
            $booth = $participant->id;
//            foreach ($participant as $part){
//                $id_participant=$part->id;
//            }
            $category = Category::find()->where(['enable' => 1])->andWhere(['id_participant' => $participant->id])->all();
            foreach ($category as $cat) {
                $id_category = $cat->id;
            }
            $category1 = ArrayHelper::map(Category::find()->where(['enable' => 1])->andWhere(['id_participant' => $participant->id])->all(), 'title', 'id');


            $product = Product::find()->where(['enable' => 1])->andWhere(['id_category' => $category1])->andWhere(['id_participant' => $participant->id])->andWhere(['id'=>$id])->one();

                $id_product = $product->id;
            $idImg=$product->id_img;
                $move = Productmove::find()->where(['enable' => 1])->andWhere(['id_product' => $id_product])->andWhere(['id'=>$idImg])->one();

//چون ما آرایه ای از فیلم داریم کد زیر اشتباه است
//                foreach ($move as $img) {
//                    $move1 = $img->move1;
//                    $move2 = $img->move2;
//                    $move3 = $img->move3;
//                    $move4 = $img->move4;
//                    $id_pro = $img->id_product;
//                }

                if ($move) {
                    $send['move1'] = $move->move1;
                    $send['move2'] = $move->move2;
                    $send['move3'] = $move->move3;
                    $send['id_pro'] = $move->id_product;
                    $send['alt']=$move->alt;
                    $sendFull[] = $send;
                }//end if $move not null
                else {
//                    $sendFull='gggg';
                }//end else $move is null


//            if ($move) {
//                $send['move1'] = $move->move1;
//                $send['move2'] = $move->move2;
//                $send['move3'] = $move->move3;
//                $send['id_pro'] = $move->id_product;
//                $sendFull[] = $send;
//            }//end if $move not null
//            else {
////                    $sendFull='gggg';
//            }//end else $move is null

//            var_dump($id_product);exit;
            foreach ($sendFull as $s) {

                $move1 = $s['move1'];
                $move2 = $s['move2'];
                $move3 = $s['move3'];
                $id_pro = $s['id_pro'];
                $alt=$s['alt'];

            }
//            exit;
            $product1 = ArrayHelper::map(Product::find()->where(['enable' => 1])->andWhere(['id_category' => $category1])->andWhere(['id_participant' => $participant->id])->all(), 'title', 'id');
//            $move = ArrayHelper::map(Productmove::find()->where(['enable' => 1])->andWhere(['id_product' => $product1])->all(),'id','move1');
//            $move2 = ArrayHelper::map(Productmove::find()->where(['enable' => 1])->andWhere(['id_product' => $product1])->all(),'id','move2');
//            $move3 = ArrayHelper::map(Productmove::find()->where(['enable' => 1])->andWhere(['id_product' => $product1])->all(),'id','move3');
//            $move=Productmove::find()->where(['enable' => 1])->andWhere(['id_product' => $product1])->all();
//            foreach ($move as $img) {
//                $move1 = $img->move1;
//                $move2 = $img->move2;
//                $move3 = $img->move3;
//                $move4 = $img->move4;
//                $id_pro = $img->id_product;


            $mov = new Productmove();

            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {

                if ($model->id_Category != null && $model->id_Category != 0 && $model->id_Category != -1) {

                    //زمانی که عکس جدید آپلود میکنیم
                    $model->fileMove1 = UploadedFile::getInstances($model, 'fileMove1');
                    $model->fileMove2 = UploadedFile::getInstance($model, 'fileMove2');
                    $model->fileMove3 = UploadedFile::getInstance($model, 'fileMove3');

//                if (($model->fileMove1 == $model->fileMove2 )&&($model->fileMove2== $model->fileMove3 )== null )
                    if ($model->fileMove1 || $model->fileMove2 || $model->fileMove3 != null) {

                        foreach ($sendFull as $s) {

//زمانی که fileMove1=null باشد دیگه نمیشه از مدل مجازی که در اون ساختیم استفاده کنیم
                            //پس ما چند نوع زخیره فایل داریم
                            // 1 - رمانی که کاربر موقه ویرایش هیچ فایلی رو آپلود نکنه و بخاد از فایلای قدیمیش استفاده کنه
                            // 2 - زمانی که کاربر بخاد عکس یا pdf اپلود کنه و فیلم آپلود نکنه که در اون صورت مانند قبل در دیتابیس ذخیره میشن
                            // 3 - زمانی که کاربر بخاد فیلم جدید آپلود کنه که کر اون صورت ما مجبور میشیم از یک مدل مجازی به نام nModel استفاده کنیم و در دیتابیس از اون برای ذخیره استفاده میکنیم
                            if ($model->fileMove1 != null) {

                                $movies = '-**-';
                                foreach ($model->fileMove1 as $movie) {

                                    $nModel = new Productmove();
                                    $basename1 = $booth . 'Product' . $movie->baseName;
                                    $movie->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename1 . '.' . $movie->extension);
                                    $movie1 = $basename1 . '.' . $movie->extension;
                                    $movies .= $movie1 . '-**-';

                                }//end foreach

                                if ($model->fileMove2 != null) {

                                    if ($model->fileMove2 != $move2) {

                                        $basename = $booth . 'Product' . $model->fileMove2->baseName;
                                        $model->fileMove2->saveAs(Yii::getAlias('@upload') . '/upload/files/' . $basename . '.' . $model->fileMove2->extension);
                                        $mov->move2 = $basename . '.' . $model->fileMove2->extension;
//                        $move1 = $basename1 . '.' . $model->file1->extension;
                                        $move2 = $mov->move2;

                                    }
                                } else {
                                    $move2 = $mov->move2 = $move2;
                                }

                                if ($model->fileMove3 != null) {

                                    if ($model->fileMove3 != $move3) {

                                        $basename = $booth . 'Product' . $model->fileMove3->baseName;
                                        $model->fileMove3->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename . '.' . $model->fileMove3->extension);
                                        $mov->move3 = $basename . '.' . $model->fileMove3->extension;
//                        $move3 = $basename . '.' . $model->file3->extension;
                                        $move3 = $mov->move3;

                                    }
                                } else {
                                    $move3 = $mov->move3 = $move3;
                                }

                                $altT = $mov->alt = $alt;
////                            echo $altT;exit;
                                $nModel->alt = $altT;


                                $fileMovies = $mov->move1 = $movies;
                                $nModel->move1 = $fileMovies;

                                $idP = $mov->id_product = $id_pro;
                                $nModel->id_product = $idP;

                                $nModel->move2 = $move2;

                                $nModel->move3 = $move3;
                                $nModel->move4 = 'void';

                                if ((($movies == $move2) && ($move2 == $move3)) != 'void') {
                                    if ($nModel->save()) {
                                        $id_img = $nModel->id;
                                    }
                                } else {
                                    $id_img = -1;
                                }

                            }//end if $fileMove1 != null
                            else {
                                $movies = $model->fileMove1 = $move1;


                                if ($model->fileMove2 != null) {

                                    if ($model->fileMove2 != $move2) {

                                        $basename = $booth . 'Product' . $model->fileMove2->baseName;
                                        $model->fileMove2->saveAs(Yii::getAlias('@upload') . '/upload/files/' . $basename . '.' . $model->fileMove2->extension);
                                        $mov->move2 = $basename . '.' . $model->fileMove2->extension;
//                        $move1 = $basename1 . '.' . $model->file1->extension;
                                        $move2 = $mov->move2;

                                    }
                                } else {
                                    $move2 = $mov->move2 = $move2;
                                }

                                if ($model->fileMove3 != null) {

                                    if ($model->fileMove3 != $move3) {

                                        $basename = $booth . 'Product' . $model->fileMove3->baseName;
                                        $model->fileMove3->saveAs(Yii::getAlias('@upload') . '/upload/video/' . $basename . '.' . $model->fileMove3->extension);
                                        $mov->move3 = $basename . '.' . $model->fileMove3->extension;
//                        $move3 = $basename . '.' . $model->file3->extension;
                                        $move3 = $mov->move3;

                                    }
                                } else {
                                    $move3 = $mov->move3 = $move3;
                                }

                                $mov->alt = $alt;
                                $mov->enable = 1;
                                $mov->move1 = $movies;
                                $mov->move2 = $move2;
                                $mov->move3 = $move3;
                                $mov->move4 = 'void';
                                $mov->id_product = $id_pro;

                                if ((($movies == $move2) && ($move2 == $move3)) != 'void') {
                                    if ($mov->save()) {
                                        $id_img = $mov->id;
                                    }
                                }//end if fileMoves != void
                                else {
                                    $id_img = -1;
                                }//end else fileMoves != void

                            }//end if $fileMove1 == null

                        }


                    }//end if 3 fileMove != null
                    else {

                        $id_img = $idImg;

                    }//end else 3 fileMove == null
                    $model->id_img = $id_img;
//                $model->id_company = $pro;

                    if ($model->save()) {
                        $transaction->commit();
                        $_SESSION['error'] = 'رکورد مورد نظر ثبت شد';
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
//                    var_dump($mov->getErrors());
//                    exit;
                        $_SESSION['error'] = 'خطا: در ذخیره سازی';
                        return $this->render('update', [
                            'model' => $model,
                            'category' => $category,
                            'move' => $move,
                            'sendFull' => $sendFull,
                        ]);
                    }
                }
                else {
                    $_SESSION['error'] = 'لطفا اول دسته مورد نظر را انتخاب کنید';
                    return $this->render('update', [
                        'model' => $model,
                        'category' => $category,
                        'move' => $move,
                        'sendFull' => $sendFull,
                    ]);
                }
//                return $this->redirect(['view', 'id' => $model->id]);
//                return $this->redirect(['view', 'id' => $model->id]);
            }//end if load
            else {
                return $this->render('update', [
                    'model' => $model,
                    'category' => $category,
                    'move' => $move,
                    'sendFull' => $sendFull,
                ]);
            }//end else load
        }//end try
        catch (Exception $e) {
            $transaction->rollBack();
            $this->refresh();
        }//end catch

    }


    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id){
        $transaction=Yii::$app->db->beginTransaction();
        try{
            $model=$this->findModel($id);
            $model->enable=0;
            if ($model->save()){
                $transaction->commit();
                $_SESSION['error']='رکورد مورد نظر حذف شد';
                return $this->redirect(['index']);
            }//end if save
            else{
                $_SESSION['error']='خطا: رکورد مورد نظر حذف نشد';
                return $this->redirect(['index']);
            }//end else save
        }//end try
        catch(Exception $e){
            $transaction->rollBack();
            $this->refresh();
        }//end catch



    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
