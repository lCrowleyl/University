<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Учебные планы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить план', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Импортировать план', ['upload'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=> 'Номер плана',
                'attribute' => 'plan_number',
                //'contentOptions'=>['style'=>'max-width: 40px; white-space: pre-wrap; '],
            ],
            [
                'label'=> 'Название специальности',
                'content'=>function($data)
                {
                    if ($data->spesiality_id == $data->spesiality->id)
                    return $data->spesiality->name_spesiality;
                } ,
            'contentOptions'=>['style'=>'max-width: 500px; white-space: pre-wrap; '],
            ],
            [
                'label'=> 'Форма обучения',
                'attribute' => 'form_of_training',
            ],
            [
                'label'=> 'Уровень обучения',
                'attribute' => 'level_of_training',
            ],
            [
                'label'=> 'Год поступления',
                'attribute' => 'year',
            ],
                        
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
