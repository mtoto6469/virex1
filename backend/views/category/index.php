<?php

use yii\helpers\Html;
use yii\grid\GridView;

$session = Yii::$app->session;
if (!$session->isActive) {
    $session->open();
} else {
}
if (isset($_SESSION['error'])) {
    if ($_SESSION['error'] != null) {
        echo '<div class="alert alert-danger  session" id="">' . $_SESSION['error'] . '</div>';
    }
    $_SESSION['error'] = null;
}

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'دسته ها';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('ثبت دسته', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
//            'id_parent',
//            'id_img',
            [
                'attribute'=>'id_img',
                'value'=>function($model){
                    $img=\backend\models\Img::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_img])->one();
                    if ($img){
                        $img=$img->fileImg;
                        return $img;
                    }else{
                        $img='عکس ثبت نشده';
                        return $img;
                    }
                }
            ],
//            'id_participant',
            [
                'attribute'=>'id_participant',

                'value'=>function($model){
                    $participant=\backend\models\Participant::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_participant])->one();
                    $profile=\backend\models\Profile::find()->where(['enable'=>1])->andWhere(['id'=>$participant->id_company])->one();
                    $a='';
                    $a.='شرکت : ';
                    $a.=$profile->company_name_en;
                    return $a;
                },
                'label'=>'غرفه دار'
            ],
            //'description',
            //'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
