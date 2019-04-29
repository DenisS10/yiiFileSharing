<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div style="width: 22%;">
    <? $form = ActiveForm::begin()?>
    <?= $form->field($model,'taskMod');?>
    <?= $form->field($model,'deadlineMod');?>
    <?= Html::submitButton('Save',['class' => 'btn btn-success']);?>
    <? ActiveForm::end()?>
</div>