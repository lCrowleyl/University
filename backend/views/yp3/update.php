<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Yp3 */

$this->title = 'Update Yp3: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Yp3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="yp3-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
