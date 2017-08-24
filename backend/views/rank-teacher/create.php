<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RankTeacher */

$this->title = 'Create Rank Teacher';
$this->params['breadcrumbs'][] = ['label' => 'Rank Teacher', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rank-teacher-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
