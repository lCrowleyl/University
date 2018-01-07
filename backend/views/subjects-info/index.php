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
            //'subjects_id',
            [
                'label'=>'Дисциплина',
                
                'content'=>function($data)
                {
                    if ($data->plan->id == $data->plan_id)
                    return $data->subjects->name_subject;
                } ,
                'contentOptions'=>['style'=>'max-width: 150px; white-space: pre-wrap; '],
            ],
            [
                'label'=>'Учебный план',
                
                'content'=>function($data)
                {
                    if ($data->plan->id == $data->plan_id)
                    return $data->plan->plan_number;
                    
                } ,
                'contentOptions'=>['style'=>'max-width: 150px; white-space: pre-wrap; '],
            ],
            //'plan_id',
            //'part_cycle_id',
            [
                'label' => 'Семестр',
                'attribute' => 'semestr',            
            ],
            [
                'label' => 'Дисциплина по выбору',
                'attribute' => 'status',
            ],            
            
            // 'lecture_time',
            // 'labs_time',
            // 'practical_time',
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
