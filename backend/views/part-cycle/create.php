<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PartCycle */

$this->title = Yii::t('app', 'Create Part Cycle');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Part Cycles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-cycle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
