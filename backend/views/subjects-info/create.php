<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SubjectsInfo */

$this->title = Yii::t('app', 'Create Subjects Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subjects Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
