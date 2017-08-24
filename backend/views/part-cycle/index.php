<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PartCycleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Part Cycles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-cycle-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Part Cycle'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_part',
            'name_part',
            'id_cycle',
            'name_cycle',
            // 'id_subcycle',
            // 'name_subcycle',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
