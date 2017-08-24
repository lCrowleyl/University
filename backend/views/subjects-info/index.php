<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SubjectsInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Дисциплины по планам');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Subjects Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'subjects_id',
            'plan_id',
            'part_cycle_id',
            'semestr',
             'status',
            // 'lecture_time:datetime',
            // 'labs_time:datetime',
            // 'practical_time:datetime',
            // 'exam',
            // 'credit',
            // 'differentiated_credit',
            // 'cource_work',
            // 'cource_project',
            // 'individual_assignment',
            // 'summ_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
