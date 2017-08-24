<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Yp3Subjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yp3-subjects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subjects_info_id')->textInput() ?>

    <?= $form->field($model, 'yp3_id')->textInput() ?>

    <?= $form->field($model, 'flows_id')->textInput() ?>

    <?= $form->field($model, 'count_week')->textInput() ?>

    <?= $form->field($model, 'semestr')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
