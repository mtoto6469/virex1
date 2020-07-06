<?php


/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index ">

    <?php
//    view users count
    $profile = \frontend\models\Profile::find()->where(['enable' => 1])->all();
    $count = \frontend\models\Profile::find()->where(['enable' => 1])->count();

    //view users online
//    $session = \frontend\models\SessionFrontendUser::find()->filterWhere(['!=', 'id_user', -1])->count();

    ?>
    <div class="visit">
        <p>تعداد اعضای سایت : </p> <?php echo ' ' . $count; ?>
        <?php
//        if ($session > 0){
        ?>

<!--        <p>تعداد اعضای آنلاین سایت : </p> --><?php //echo ' ' . $session; ?><!--نفر-->
    </div>
<?php
//}
?>
    
</div>
