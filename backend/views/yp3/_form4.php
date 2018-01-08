<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;
/* @var $this yii\web\View */
/* @var $model common\models\Yp3Subjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yp3-subjects-form">
    <?=$model->subjectsInfo->name_subject?>
    <?=$model->flows->name?>
    <?=$model->all?>
    <?php $form = ActiveForm::begin(); ?>
<?= MultiSelect::widget([
    'data' => \yii\helpers\ArrayHelper::map(\common\models\Teachers::find()->orderBy(['last_name' => SORT_ASC])->all(), 'id', 'last_name'),
    'model' => $yp4,
    'attribute' => 'teachers_ids',
    "options" => ['multiple'=>"multiple"], // for the actual multiselect
]) ?>

    <?= $form->field($yp4, 'count')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
