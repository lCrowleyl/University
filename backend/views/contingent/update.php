<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contingent */

$this->title = 'Update Contingent: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contingents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contingent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
