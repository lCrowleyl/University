<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PartCycle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="part-cycle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_part')->textInput() ?>

    <?= $form->field($model, 'name_part')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_cycle')->textInput() ?>

    <?= $form->field($model, 'name_cycle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_subcycle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_subcycle')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
