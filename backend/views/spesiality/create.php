<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Spesiality */

$this->title = Yii::t('app', 'Create Spesiality');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spesialities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spesiality-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
