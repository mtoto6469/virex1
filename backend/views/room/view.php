<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Room', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-view col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ویرایش', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('حذف', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'آیا واقعا میخاهید این غرفه را حذف کنید?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'id_country',
        [
            'attribute'=>'id_country',
            'value'=>function($model){
                $country=\backend\models\Country::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_country])->one();
                $countryX=$country->country_name;
                return $countryX;
            }
        ],
//            'id_exhibition',
        [
            'attribute'=>'id_exhibition',
            'value'=>function($model){
                $exhibition=\backend\models\Exhibitionn::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_exhibition])->one();
                $exhibitionX=$exhibition->title;
                return $exhibitionX;
            }
        ],
//            'id_activity',
            'id_img',
            'price',
            'description',
//            'enable',
        ],
    ]) ?>

</div>
