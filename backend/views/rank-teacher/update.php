<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RankTeacher */

$this->title = 'Update Rank Teacher: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rank Teacher', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rank-teacher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
