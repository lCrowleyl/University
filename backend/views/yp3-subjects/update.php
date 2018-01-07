<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Yp3Subjects */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Yp3 Subjects',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yp3 Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="yp3-subjects-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
