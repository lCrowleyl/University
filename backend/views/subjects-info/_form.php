<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SubjectsInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subjects-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subjects_id')->textInput() ?>

    <?= $form->field($model, 'plan_id')->textInput() ?>

    <?= $form->field($model, 'part_cycle_id')->textInput() ?>

    <?= $form->field($model, 'semestr')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'lecture_time')->textInput() ?>

    <?= $form->field($model, 'labs_time')->textInput() ?>

    <?= $form->field($model, 'practical_time')->textInput() ?>

    <?= $form->field($model, 'exam')->textInput() ?>

    <?= $form->field($model, 'credit')->textInput() ?>

    <?= $form->field($model, 'differentiated_credit')->textInput() ?>

    <?= $form->field($model, 'cource_work')->textInput() ?>

    <?= $form->field($model, 'cource_project')->textInput() ?>

    <?= $form->field($model, 'individual_assignment')->textInput() ?>

    <?= $form->field($model, 'summ_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
