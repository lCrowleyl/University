<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Yp3Subjects */

$this->title = Yii::t('app', 'Create Yp3 Subjects');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yp3 Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yp3-subjects-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
