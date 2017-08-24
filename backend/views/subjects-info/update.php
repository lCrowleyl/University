<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SubjectsInfo */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Subjects Info',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subjects Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="subjects-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
