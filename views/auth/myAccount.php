<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;?>

<div style="width: 22%;">
    <? $form = ActiveForm::begin()?>
    <?= $form->field($model,'oldPass')->passwordInput();?>
    <?= $form->field($model,'newPass')->passwordInput();?>
    <?= $form->field($model,'repeatNewPass')->passwordInput();?>
    <?= Html::submitButton('Change password',['class' => 'btn btn-primary']);?>
    <? ActiveForm::end()?>
</div>