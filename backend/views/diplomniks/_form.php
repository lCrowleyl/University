<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Diplomniks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diplomniks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'teachers_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Teachers::find()->orderBy(['last_name' => SORT_ASC])->all(), 'id', 'last_name'), ['prompt' => '-']) ?>

    <?= $form->field($model, 'flow_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Flows::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'), ['prompt' => '-']) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
