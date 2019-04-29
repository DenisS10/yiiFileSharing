<?php
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;?>
<!---->
<?//='<pre>';
//print_r($_POST);
//?>
<!---->
<!--<div style="width: 22%;">-->
<!--    --><?// $form = ActiveForm::begin()?>
<?//= $form->field($model,'task');?>
<?//= $form->field($model,'deadline');?>
<?//= Html::submitButton('Send',['class' => 'btn btn-primary']);?>
<!---->
<?// ActiveForm::end()?>
<!--</div>-->
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

//echo '<pre>';
//print_r($model);
//exit();
//if(Yii::$app->session->hasFlash('success')):
//    echo Yii::$app->session->getFlash('success');
//  //  $this->refresh();
//endif;

//if(Yii::$app->session->hasFlash('error')):
//    echo Yii::$app->session->getFlash('error');
//
//endif;
?>

<div style="width: 22%;">
    <? $form = ActiveForm::begin()?>
    <?= $form->field($model,'task');?>
    <?= $form->field($model,'deadline');?>
    <?= Html::submitButton('Send',['class' => 'btn btn-success']);?>
    <? ActiveForm::end()?>
</div>
