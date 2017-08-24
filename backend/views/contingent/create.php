<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Contingent */

$this->title = 'Create Contingent';
$this->params['breadcrumbs'][] = ['label' => 'Contingents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contingent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
