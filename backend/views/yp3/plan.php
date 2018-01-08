<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $model common\models\Yp3 */
$totallec = 0;
$totalpract = 0;
$totallabs= 0;
$totalnirs = 0;
?>
<div class="yp3-view">
 <?php $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
            [
                
                'label'=>'Преп',
                
                'content'=>function($data){
                return $data->teachers ? $data->teachers->last_name : '-';
                }
            ],
            [
                'attribute'=>'subjects_info_id',
                'label'=>'Предмет',
                
                'content'=>function($data){
                    return $data->subjectsInfo ? $data->subjectsInfo->name_subject : '-';
                }
            ],
            [
                'attribute'=>'subjects_info_id',
                'label'=>'Факультет',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->facultu : '-';
                }
            ],
             [
                'attribute'=>'cource',
                'label'=>'COURCE',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->cource : '-';
                }
            ],  
            [
                'attribute'=>'student_count',
                'label'=>'student_count',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->student_count : '-';
                }
            ],
                    
            [
                'attribute'=>'subjects_info_id',
                'label'=>'Группа',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->name : '-';
                }
            ],
               [
                'attribute'=>'weeks',
                'label'=>'weeks',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->weeks : '-';
                }
            ],   
                    [
                'attribute'=>'groups',
                'label'=>'groups',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->groups : '-';
                }
            ],  
                    [
                'attribute'=>'small_groups',
                'label'=>'small_groups',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->small_groups : '-';
                }
            ],  
            [
                'attribute' => 'lections',
                'format' => 'raw',
                'content'=>function($data){
                    return $data->lections ? $data->lections : '0';
                },
                 'footer' =>common\models\Yp4Subjects::getTotal('lections', $id, $teachers_id, $semestr)
            ],   
                          [
                'attribute' => 'pract',
                'format' => 'raw',
                              'content'=>function($data){
                    return $data->pract ? $data->pract : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('pract', $id, $teachers_id, $semestr)
            ],   
                            [
                'attribute' => 'labs',
                'format' => 'raw',
                                'content'=>function($data){
                    return $data->labs ? $data->labs : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('labs', $id, $teachers_id, $semestr)
            ],   
              [
                'attribute' => 'nirs',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->nirs ? $data->nirs : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('nirs', $id, $teachers_id, $semestr)
            ],   
                         [
                'attribute' => 'kontz_zao',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->kontz_zao ? $data->kontz_zao : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('kontz_zao', $id, $teachers_id, $semestr)
            ], 
                                   [
                'attribute' => 'kons',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->kons ? $data->kons : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('kons', $id, $teachers_id, $semestr)
            ], 
                                               [
                'attribute' => 'ekzam_kons',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->ekzam_kons ? $data->ekzam_kons : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('ekzam_kons', $id, $teachers_id, $semestr)
            ], 
                                                          [
                  'content'=>function($data){
                    return '0';
                },
                 'footer' => 0
            ], 
                                                                   [
                  'content'=>function($data){
                    return '0';
                },
                 'footer' => 0
            ], 
                                                                   [
                  'content'=>function($data){
                    return '0';
                },
                 'footer' => 0
            ], 
            [
                'attribute' => 'kontr',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->kontr ? $data->kontr : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('kontr', $id, $teachers_id, $semestr)
            ], 
            [
                'attribute' => 'kyrs',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->kyrs ? $data->kyrs : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('kyrs', $id, $teachers_id, $semestr)
            ], 
                         [
                'attribute' => 'zach',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->zach ? $data->zach : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('zach', $id, $teachers_id, $semestr)
            ], 
                                    [
                'attribute' => 'eczam',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->eczam ? $data->eczam : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('eczam', $id, $teachers_id, $semestr)
            ], 
                                      [
                'attribute' => 'practic',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->practic ? $data->practic : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('practic', $id, $teachers_id, $semestr)
            ],    
                                                                              [
                  'content'=>function($data){
                    return '0';
                },
                 'footer' => 0
            ], 
            [
                'attribute' => 'recen',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->recen ? $data->recen : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('recen', $id, $teachers_id, $semestr)
            ], 
            [
                  'content'=>function($data){
                    return '0';
                },
                 'footer' => 0
            ], 
                        [
                'attribute' => 'dr',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->dr ? $data->dr : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('dr', $id, $teachers_id, $semestr)
            ], 
];?>
   <?= ExportMenu::widget([
    'dataProvider' => $yp4Dp,
    'columns' => $gridColumns
]); ?>
    <?= GridView::widget([
        'dataProvider' => $yp4Dp,
        //'filterModel' => $searchModel,
        'showFooter'=>TRUE,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
              
            'id',
            [
                'content'=>function($data){
                    return $data->ypSubjects ? $data->ypSubjects->semestr : '-';
                }
            ],
            [
                'attribute'=>'subjects_info_id',
                'label'=>'Предмет',
                
                'content'=>function($data){
                    return $data->subjectsInfo ? $data->subjectsInfo->name_subject : '-';
                }
            ],
            [
                'attribute'=>'subjects_info_id',
                'label'=>'Факультет',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->facultu : '-';
                }
            ],
             [
                'attribute'=>'cource',
                'label'=>'COURCE',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->cource : '-';
                }
            ],  
            [
                'attribute'=>'student_count',
                'label'=>'student_count',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->student_count : '-';
                }
            ],
                    
            [
                'attribute'=>'subjects_info_id',
                'label'=>'Группа',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->name : '-';
                }
            ],
               [
                'attribute'=>'weeks',
                'label'=>'weeks',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->weeks : '-';
                }
            ],   
                    [
                'attribute'=>'groups',
                'label'=>'groups',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->groups : '-';
                }
            ],  
                    [
                'attribute'=>'small_groups',
                'label'=>'small_groups',
                
                'content'=>function($data){
                    return $data->flows ? $data->flows->small_groups : '-';
                }
            ],  
            [
                'attribute' => 'lections',
                'format' => 'raw',
                'content'=>function($data){
                    return $data->lections ? $data->lections : '0';
                },
                 'footer' =>common\models\Yp4Subjects::getTotal('lections', $id, $teachers_id, $semestr)
            ],   
                          [
                'attribute' => 'pract',
                'format' => 'raw',
                              'content'=>function($data){
                    return $data->pract ? $data->pract : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('pract', $id, $teachers_id, $semestr)
            ],   
                            [
                'attribute' => 'labs',
                'format' => 'raw',
                                'content'=>function($data){
                    return $data->labs ? $data->labs : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('labs', $id, $teachers_id, $semestr)
            ],   
              [
                'attribute' => 'nirs',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->nirs ? $data->nirs : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('nirs', $id, $teachers_id, $semestr)
            ],   
                         [
                'attribute' => 'kontz_zao',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->kontz_zao ? $data->kontz_zao : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('kontz_zao', $id, $teachers_id, $semestr)
            ], 
                                   [
                'attribute' => 'kons',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->kons ? $data->kons : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('kons', $id, $teachers_id, $semestr)
            ], 
                                               [
                'attribute' => 'ekzam_kons',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->ekzam_kons ? $data->ekzam_kons : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('ekzam_kons', $id, $teachers_id, $semestr)
            ], 
                                                          [
                  'content'=>function($data){
                    return '0';
                },
                 'footer' => 0
            ], 
                                                                   [
                  'content'=>function($data){
                    return '0';
                },
                 'footer' => 0
            ], 
                                                                   [
                  'content'=>function($data){
                    return '0';
                },
                 'footer' => 0
            ], 
            [
                'attribute' => 'kontr',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->kontr ? $data->kontr : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('kontr', $id, $teachers_id, $semestr)
            ], 
            [
                'attribute' => 'kyrs',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->kyrs ? $data->kyrs : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('kyrs', $id, $teachers_id, $semestr)
            ], 
                         [
                'attribute' => 'zach',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->zach ? $data->zach : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('zach', $id, $teachers_id, $semestr)
            ], 
                                    [
                'attribute' => 'eczam',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->eczam ? $data->eczam : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('eczam', $id, $teachers_id, $semestr)
            ], 
                                      [
                'attribute' => 'practic',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->practic ? $data->practic : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('practic', $id, $teachers_id, $semestr)
            ],    
                                                                              [
                  'content'=>function($data){
                    return '0';
                },
                 'footer' => 0
            ], 
            [
                'attribute' => 'recen',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->recen ? $data->recen : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('recen', $id, $teachers_id, $semestr)
            ], 
            [
                  'content'=>function($data){
                    return '0';
                },
                 'footer' => 0
            ], 
                        [
                'attribute' => 'dr',
                'format' => 'raw',
                  'content'=>function($data){
                    return $data->dr ? $data->dr : '0';
                },
                 'footer' => common\models\Yp4Subjects::getTotal('dr', $id, $teachers_id, $semestr)
            ], 
            
            [
                
                'label'=>'Преп',
                
                'content'=>function($data){
                return $data->teachers ? $data->teachers->last_name : '-';
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
</div>
