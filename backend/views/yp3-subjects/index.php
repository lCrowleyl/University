<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Yp3SubjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Yp3 Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yp3-subjects-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Yp3 Subjects', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'subjects_info_id',
            'yp3_id',
            'flows_id',
            'count_week',
            // 'semestr',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
