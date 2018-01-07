<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Yp3SubjectsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yp3-subjects-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'subjects_info_id') ?>

    <?= $form->field($model, 'yp3_id') ?>

    <?= $form->field($model, 'flows_id') ?>

    <?= $form->field($model, 'count_week') ?>

    <?php // echo $form->field($model, 'semestr') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
