<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SubjectsInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subjects-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'subjects_id') ?>

    <?= $form->field($model, 'plan_id') ?>

    <?= $form->field($model, 'part_cycle_id') ?>

    <?= $form->field($model, 'semestr') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'lecture_time') ?>

    <?php // echo $form->field($model, 'labs_time') ?>

    <?php // echo $form->field($model, 'practical_time') ?>

    <?php // echo $form->field($model, 'exam') ?>

    <?php // echo $form->field($model, 'credit') ?>

    <?php // echo $form->field($model, 'differentiated_credit') ?>

    <?php // echo $form->field($model, 'cource_work') ?>

    <?php // echo $form->field($model, 'cource_project') ?>

    <?php // echo $form->field($model, 'individual_assignment') ?>

    <?php // echo $form->field($model, 'summ_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
