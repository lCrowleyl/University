<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Diplomniks */

$this->title = 'Update Diplomniks: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Diplomniks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="diplomniks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
