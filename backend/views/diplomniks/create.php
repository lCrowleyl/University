<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Diplomniks */

$this->title = 'Create Diplomniks';
$this->params['breadcrumbs'][] = ['label' => 'Diplomniks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diplomniks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
