<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PartCycleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="part-cycle-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_part') ?>

    <?= $form->field($model, 'name_part') ?>

    <?= $form->field($model, 'id_cycle') ?>

    <?= $form->field($model, 'name_cycle') ?>

    <?php // echo $form->field($model, 'id_subcycle') ?>

    <?php // echo $form->field($model, 'name_subcycle') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
