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
/* @var $model backend\models\Participant */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Participants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-view col-sm-10">

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
//            'id',
//            'id_country',
        [
            'attribute'=>'id_country',
            'value'=>function($model){
                $country=\backend\models\Country::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_country])->one();
                $countryX=$country->country_name;
                return $countryX;
            },
            'label'=>'کشور',
        ],
//            'id_exhibitionn',
        [
            'attribute'=>'id_exhibition',
            'value'=>function($model){
                $exhibition=\backend\models\Exhibitionn::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_exhibitionn])->one();
                $exhibitionX=$exhibition->title;
                return $exhibitionX;
            },
            'label'=>'نمایشگاه',
        ],
            'id_room',
//            'id_company',
            [
                'attribute'=>'id_company',
                'value'=>function($model){
                    $profile=\backend\models\Profile::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_company])->one();
                    $profileX=$profile->username;
                    return $profileX;
                },
                'label'=>'نام کاربری',
            ],
//            'id_activity',
            [
                'attribute'=>'id_activity',
                'value'=>function($model){
                    $activity=\backend\models\Activity::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_activity])->one();
                    $activityX=$activity->activity;
                    return $activityX;
                },
                'label'=>'نوع فعالیت',
            ],
//            'teaser',
            'responsible_name:ntext',
            'semat:ntext',
            'email:email',
            'fax:ntext',
            'site_address',
            'telegram',
            'instagram',
            'shortdescription:ntext',
            'dsescription:ntext',
            'buy',
//            'enable',
        ],
    ]) ?>

</div>
