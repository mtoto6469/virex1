<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Profile */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view col-lg-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'role',
            'name',
            'username',
            'id_user',
            'email:email',
            'password',
            'telephone',
            'mobile',
            'company_name_en',
            'company_name_ir',
            'date',
            'date_ir',
            'date_update',
            'date_update_ir',
//            'state',
            ['attribute' => 'state',
                'value' => function ($model) {
                    if ($model->state == 1) {
                        return 'فعال';
                    } else {
                        return 'غیرفعال';
                    }
                }//end function
            ],
            'id_img',
//            'rules',
//            'code',
//            'enable',
        ],
    ]) ?>

</div>
