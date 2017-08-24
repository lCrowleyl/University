<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Spesiality */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spesiality-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'direction_id')->textInput() ?>

    <?= $form->field($model, 'name_spesiality')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
