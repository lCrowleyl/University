<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Yp3 */
$this->registerJs('
    $(document).ready(function() {
     
    $(".select").on("change", function() {
    var $this = $(this);
        $.ajax({
            url: "'.Url::toRoute(['/yp3/setyp4pr']).'",
            dataType: "json",
            data: {
                id: $this.data("id"),
                user_id: $this.val(),
                visible:$(".form.form--order").is(":visible") ? 1:0
            },
            success: function(msg) {
                if (msg.success) {
                $this.parents(".selectric-wrapper").find(".selectric .label").toggleClass("ship").toggleClass("air");
                }
            }
        });
    });
   
        
    });
');

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Yp3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yp3-view">

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
            'id',
            'date',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $yp3Dp,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'subjects_info_id',
                'label'=>'Предмет',
                
                'content'=>function($data){
                    return $data->subjectsInfo->name_subject;
                }
            ],
                    [
                'attribute'=>'subjects_info_id',
                'label'=>'Группа',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->name : '-';
                }
            ],
            'id',
          //  'date',
        'semestr',
            'lections',
            'labs',
            'pract',
            'kyrs',
                    'nirs',
                    'all',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $yp4Dp,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'subjects_info_id',
                'label'=>'Предмет',
                
                'content'=>function($data){
                    return $data->subjectsInfo ? $data->subjectsInfo->name_subject : '-';
                }
            ],
            [
                'attribute'=>'subjects_info_id',
                'label'=>'Группа',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->name : '-';
                }
            ],
                'semestr',    
            'lections',
            'labs',
            'pract',
            'kyrs',
                    'kontz_zao',
                    'kons',
                    'ekzam_kons',
                    'kontr',
                    'zach',
                    'eczam',
            [
                
                'label'=>'Преп',
                
                'content'=>function($data){
                    return Html::dropDownList(
                            'teatcher', 
                            $data->teachers_id, 
                            \yii\helpers\ArrayHelper::map(\common\models\Teachers::find()->orderBy(['last_name' => SORT_ASC])->all(), 'id', 'last_name'),
                            ['class' =>'select', 'data-id' => $data->id, 'prompt'=>'Empty string']
                            );
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
