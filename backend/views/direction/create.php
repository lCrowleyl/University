<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Direction */

$this->title = 'Добавить направление подготовки';
$this->params['breadcrumbs'][] = ['label' => 'Directions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
