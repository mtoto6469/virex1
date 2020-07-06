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
        echo '<div class="alert alert-danger  session" id="">' . $_SESSION['error'] . '</div>';
    }
    $_SESSION['error'] = null;
}

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view col-sm-10">

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
            'description',
//            'enable',
        ],
    ]) ?>

</div>
