<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Yp3 */

$this->title = Yii::t('app', 'Create Yp3');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yp3s'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yp3-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
