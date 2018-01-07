<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RankTeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Должность';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rank-teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rank Teacher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label'=> 'Должность',
                'attribute' => 'rank_name',
            ],
//            'rank_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
