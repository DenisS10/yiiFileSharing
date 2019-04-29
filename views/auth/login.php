<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


    ?>

<div style="width: 22%;">
<? $form = ActiveForm::begin()?>
<?= $form->field($model,'username');?>
<?= $form->field($model,'password')->passwordInput();?>
<?= Html::submitButton('Login',['class' => 'btn btn-success']);?>
<? ActiveForm::end()?>
</div>
