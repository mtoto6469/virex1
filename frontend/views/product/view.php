<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
$session = Yii::$app->session;
if (!$session->isActive) {
    $session->open();
} else {
}
if (isset($_SESSION['error'])) {
    if ($_SESSION['error'] != null) {
        echo '<div class="alert alert-info session" id="">' . $_SESSION['error'] . '</div>';
    }
    $_SESSION['error'] = null;
}

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ویرایش', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('حذف', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
//            'id_participant',
        [
            'attribute'=>'id_participant',
            'value'=>function($model){
                $participant=\frontend\models\Participant::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_participant])->one();
//                echo $participant->id_company;exit;
                $profile=\frontend\models\Profile::find()->where(['enable'=>1])->andWhere(['id'=>$participant->id_company])->one();

                if ($profile){
                    $a='';
                    $a.='شرکت : ';
                    $a.=$profile->company_name_en;

                    return $a;
                }else{
                    var_dump($profile->getErrors());exit;
                    return null;
                }


            },
            'label'=>'غرفه دار'
        ],
            'typePro',
//            'id_img',
        [
            'attribute'=>'id_img',
            'value'=>function($model){
                $image=\frontend\models\Productmove::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_img])->andWhere(['id_product'=>$model->id])->one();
                if ($image){

                    $img='فایل ها ثبت شده اند';
                    return $img;
                }else{
                    $img='فایل ها ثبت نشده اند';
                    return $img;
                }
            },
            'label'=>'فیلم و عکس '
        ],
//            'id_Category',
            [
                'attribute'=>'id_category',
                'value'=>function($model){
                    $category=\frontend\models\Category::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_Category])->one();
                    if ($category){
                        $category=$category->title;
                        return $category;
                    }
                },
                'label'=>'عنوان دسته'
            ],
            'shortDescription',
            'description:ntext',
//            'enable',
        ],
    ]) ?>

</div>
