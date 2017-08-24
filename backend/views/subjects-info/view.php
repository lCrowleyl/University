<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SubjectsInfo */

$this->title = $model->subjects->name_subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Дисциплина по плану'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            [
            'label'  => 'Учебный план',
            'value'  => $model->plan->plan_number,
            ],
            [
                'label'  => 'Семестр №',
            'value'  => $model->semestr,
            ],
            [
            'label'  => 'Статус дисциплины',
            'value'  => $model->status,
            ],
            [
            'label'=>'Кол-тво часов лек.',
                'value' => $model->lecture_time,
                
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],
            ],
            [
            'label'=>'Кол-тво часов лаб.',
                'value' => $model->labs_time,
                
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],
            ],
            [
            'label'=>'Кол-тво часов прак.',
                'value' => $model->practical_time,
                
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],
            ],
            [
            'label'=>'Наличие экзамена',
                'value' => $model->exam,
                
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],
            ],
            [
            'label'=>'Наличие зачета',
                'value' => $model->credit,
                
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],
            ],
            [
            'label'=>'Наличие дифференцированного зачета',
            'value' => $model->differentiated_credit,
                
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],
            ],
            [
            'label'=>'Наличие курсовой работы',
            'value' => $model->cource_work,
                
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],
            ],
            [
            'label'=>'Наличие курсового проекта',
            'value' => $model->cource_project,
                
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],
            ],
            [
            'label'=>'Наличие индивидуального задания',
            'value' => $model->individual_assignment,
                
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],
            ],
            [
            'label'=>'Сумма часов на дисциплину',
            'value' => $model->summ_time,
                
                'contentOptions'=>['style'=>'max-width: 20px; white-space: pre-wrap; '],
            ],
            
        ],
    ]) ?>

</div>
