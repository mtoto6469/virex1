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
        echo '<div class="alert alert-danger  session" id="">' . $_SESSION['erro'] . '</div>';
    }
    $_SESSION['error'] = null;
}

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-index col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Participant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'id_country',
            [
                'attribute' => 'id_country',
                'value' => function ($model) {
                    $country = \backend\models\Country::find()->where(['enable' => 1])->andWhere(['id'=>$model->id_country])->one();
                    if ($country) {
                        return $country->country_name;
                    } else {
                        return null;
                    }
                }
            ],
//            'id_exhibitionn',
            [
                'attribute' => 'id_exhibition',
                'value' => function ($model) {
                    $exhibition = \backend\models\Exhibitionn::find()->where(['enable' => 1])->andWhere(['id'=>$model->id_exhibitionn])->one();
                    if ($exhibition) {
                        return $exhibition->title;
                    } else {
                        return null;
                    }
                }
            ],
            'id_room',

//            'id_company',
            [
                'attribute' => 'id_company',
                'value' => function ($model) {
                    $company = \backend\models\Profile::find()->where(['enable' => 1])->andWhere(['id' => $model->id_company])->one();
                    if ($company) {
                        return $company->company_name_en;
                    } else {
                        return null;
                    }
                }
            ],
            //'id_activity',
            //'teaser',
            //'responsible_name:ntext',
            //'semat:ntext',
            //'email:email',
            //'fax:ntext',
            //'site_address',
            //'telegram',
            //'instagram',
            //'shortdescription:ntext',
            //'dsescription:ntext',
            //'buy',
            //'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
