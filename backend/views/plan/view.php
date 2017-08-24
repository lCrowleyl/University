<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Plan */

$this->title = $model->plan_number;
$this->params['breadcrumbs'][] = ['label' => 'Учебный план', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="plan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
            'label'  => 'Специальнность',
            'value'  => $model->spesiality->name_spesiality,
            ],
            [
                'label'=> 'Номер плана',
                'value' => $model->plan_number,
            ],
            [
                'label'=> 'Форма обучения',
                'value' => $model->form_of_training,
            ],
            [
                'label'=> 'Уровень обучения',
                'value' => $model->level_of_training,
            ],
            [
                'label'=> 'Год поступления',
                'value' => $model->year,
            ],
            ],
    ]) ?>
    
    <?= GridView::widget([
        'dataProvider' => $subjectsprovider,
        'filterModel' => $subjects,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                'label'=>'Цикл',
                'content'=>function($data){
                    if (!$data->partCycle->id_part == NULL)
                    return $data->partCycle->name_part . '. '
                            . $data->partCycle->name_cycle . '. '
                            . $data->partCycle->name_subcycle;
                    if ($data->partCycle->id_part  == NULL)
                    return $data->partCycle->name_cycle . '. '
                            . $data->partCycle->name_subcycle;
                    
                },
                'contentOptions'=>['style'=>'max-width: 150px; white-space: pre-wrap; '],
            ],
            [
                'label'=>'Семестр №',
                'attribute' => 'semestr'
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                
                
                'checkboxOptions' => function($model) {
                return ['checked' => $model->subjects->is_self,
                    'data-modelId' => $model->subjects->id];
                },
            ],
            [
               'label'=>'Кол-тво часов лек.',
                'content'=>function($data)
                {
                    return $data->lecture_time;
                } ,
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '], 
            ],
            [
               'label'=>'Кол-тво часов лаб.',
                'content'=>function($data)
                {
                    return $data->labs_time;
                } ,
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '], 
            ],
            [
               'label'=>'Кол-тво часов прак.',
                'content'=>function($data)
                {
                    return $data->practical_time;
                } ,
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '], 
            ],
            [
               'label'=>'Форма отчетности',
                'content'=>function($data)
                {
                    if (!$data->exam == NULL)
                    return 'Экзамен';
                    
                    if (!$data->credit == NULL)
                    return 'Зачет';
                    
                    if (!$data->differentiated_credit == NULL)
                    return 'Диф. зачет';
                } ,
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '], 
            ],
            [
                 'label'=>'К/р К/п',
                'content'=>function($data)
                {
                    if (!$data->cource_work == NULL)
                    return 'К/р';
                    
                    if (!$data->cource_project == NULL)
                    return 'К/п';
                                        
                } ,
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],           
            ],
            [
                 'label'=>'Инд. зад',
                'content'=>function($data)
                {
                    if (!$data->individual_assignment == NULL)
                    return '+';
                                  
                } ,
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],           
            ],            
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Редактирование',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                                $url, [ 'title' => Yii::t('app', 'Просмотреть'),
                        ]);
                    },

                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                $url, ['title' => Yii::t('app', 'Редактировать'),
                        ]);
                    },
                            
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                                $url, ['title' => Yii::t('app', 'Удалить'),
                        ]);
                    }

                ],
                        
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url ='/subjects-info/view?id='.$model->id;
                return $url;
                }

                if ($action === 'update') {
                    $url ='/subjects-info/update?id='.$model->id;
                return $url;
                }
                
                if ($action === 'delete') {
                    $url ='/subjects-info/delete?id='.$model->id;
                return $url;
                }

            }
                ],
        ],
                       
    ]); 
            ?>

</div>


