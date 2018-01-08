<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use PHPExcel;
use PHPExcel_IOFactory;
use arogachev\excel\import\basic\Importer;
use yii\helpers\ArrayHelper;
use common\models\Direction;
use common\models\Spesiality;
use common\models\Plan;
use common\models\PartCycle;
use common\models\Subjects;
use common\models\SubjectsInfo;

/**
 * UploadForm is the model behind the upload form.
 */
class YPUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $exelFile;

    public function rules()
    {
        return [
            
            [['exelFile'], 'file', 'skipOnEmpty' => false,],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->importPlanTitle($this->exelFile);
            return true;
        } else {
            return false;
        }
    }
    
    public function importPlanTitle ($file) {
        
        $format = \PHPExcel_IOFactory::identify($file->tempName);
        $objectreader = \PHPExcel_IOFactory::createReader($format);
        $objectPhpExcel = $objectreader->load($file->tempName);
        $sheetCount = $objectPhpExcel->getSheetCount();
        $sheetNames = $objectPhpExcel->getSheetNames();
        
//        array_pop($sheetNames);
       // array_pop($sheetNames);
        
        
		if ($sheetCount > 1) {
            $yp3 = new \common\models\Yp3;
            $yp3->save();
            //$headName = array_shift($sheetNames);
            foreach ($sheetNames as $key => $headName) {
                $objectPhpExcel->setActiveSheetIndexByName($headName);
                $headData = $objectPhpExcel->getActiveSheet()->toArray(null, true, true, true);
               
                foreach ($headData as $dataRorw) {
                    $dataRorw = array_filter($dataRorw);
                    if (count($dataRorw) < 2 ) {
                        $value = array_values($dataRorw); 
                        if (isset($value[0])) {
                            if($value[0] == 'Заочная форма обучения') {
                                $facult = 'ИИТЗО';
                            } 
                            if($value[0] == 'Дневная форма обучения') {
                                $facult = null;
                            } 
                        }
                    } else {
                        if (!$subject = Subjects::find()->where(['name_subject' => $dataRorw['B']])->one()) {
                            $subject = new Subjects;
                        } 
                        $subject->name_subject = $dataRorw['B'];
                        $subject->save();
                        if (!isset($dataRorw['F']) || !$flow = \common\models\Flows::find()->where(['name' => $dataRorw['F']])->one()) {
                            $flow = new \common\models\Flows;
                        }
                        if (!isset($facult)) {
                            $facult = $dataRorw['C'];
                        }
                        $flow->facultu = $facult;
                        $flow->cource = isset($dataRorw['D']) ? $dataRorw['D'] : '-';
                        $flow->student_count = isset($dataRorw['E']) ? $dataRorw['E'] : 0;
                        $flow->name = isset($dataRorw['F']) ? $dataRorw['F'] : 0;
                        $flow->weeks = isset($dataRorw['G']) ? $dataRorw['G'] : 0;
                        $flow->groups = isset($dataRorw['H']) ? $dataRorw['H'] : 0;
                        $flow->small_groups = isset($dataRorw['I']) ? $dataRorw['I'] : 0;
                        $flow->save(false);
                        $yp3Sub = new \common\models\Yp3Subjects;
                        $yp3Sub->subjects_info_id = $subject->id;
                        $yp3Sub->yp3_id = $yp3->id;
                        $yp3Sub->flows_id = $flow->id;
                        $yp3Sub->semestr = $key +1;
                        $yp3Sub->lections = isset($dataRorw['W']) ? $dataRorw['W'] : 0 ;
                        $yp3Sub->pract = isset($dataRorw['X']) ? $dataRorw['X'] : 0 ;
                        $yp3Sub->labs = isset($dataRorw['Y']) ? $dataRorw['Y'] : 0 ;
                        $yp3Sub->nirs = isset($dataRorw['Z']) ? $dataRorw['Z'] : 0 ;
                        if (isset($dataRorw['AA'])) {
                            $yp3Sub->kontz_zao = isset($dataRorw['AA']) ? $dataRorw['AA'] : 0 ;
                        }
                        $yp3Sub->kons = isset($dataRorw['AB']) ? $dataRorw['AB'] : 0 ;
                        $yp3Sub->ekzam_kons = isset($dataRorw['AC']) ? $dataRorw['AC'] : 0 ;
                        $yp3Sub->kontr = isset($dataRorw['AG']) ? $dataRorw['AG'] : 0 ;
                        $yp3Sub->kyrs = isset($dataRorw['AH']) ? $dataRorw['AH'] : 0 ;
                        $yp3Sub->zach = isset($dataRorw['AI']) ? $dataRorw['AI'] : 0 ;
                        $yp3Sub->eczam = isset($dataRorw['AJ']) ? $dataRorw['AJ'] : 0 ;
                        $yp3Sub->practic = isset($dataRorw['AK']) ? $dataRorw['AK'] : 0 ;
                        $yp3Sub->recen = isset($dataRorw['AM']) ? $dataRorw['AM'] : 0 ;
                        $yp3Sub->dr = isset($dataRorw['AO']) ? $dataRorw['AO'] : 0 ;
                        $yp3Sub->all = isset($dataRorw['AP']) ? $dataRorw['AP'] : 0 ;
                        $yp3Sub->save(false);      
                        
                    }
                }
            }
        
    }
    
    }
        
    
}
	