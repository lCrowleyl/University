<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Plan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'spesiality_id')->textInput() ?>

    <?= $form->field($model, 'plan_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'form_of_training')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level_of_training')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>
    
    
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        
               
        
    </div>
        
    <?php ActiveForm::end(); ?>

</div>
