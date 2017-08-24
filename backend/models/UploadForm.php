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
class UploadForm extends Model
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
        
        array_pop($sheetNames);
        array_pop($sheetNames);
        
        
		if ($sheetCount > 1) {
            
            $headName = array_shift($sheetNames);
            $objectPhpExcel->setActiveSheetIndexByName($headName);
            $headData = $objectPhpExcel->getActiveSheet()->toArray(null, true, true, true);
            $headInf = ArrayHelper::getColumn($headData, 'A');
            
            $headIn = [
                "$headInf[2]",
                "$headInf[3]",
                "$headInf[9]",
                "$headInf[10]",
                "$headInf[11]"];
            
            $inf =  implode(" ", $headIn);
            $infdop = explode("№", $inf);
            $infall = explode(" ", $infdop[1]);
            $a = $infall[5];
            $a = trim($a);
            $infCypher = explode(" ", $a);
            $dirplan1 = array_slice($infCypher, 1, count($infCypher));
            $cypherPlan = $infCypher[0];
            $dirplan =  implode(" ", $dirplan1);
            $spesialityPlan = $infall[8];
            
//Добавление направления если нет такого шифра
            if (!$modelDirection = Direction::find()
                    ->where(["cypher" => $cypherPlan])
                    ->one()){
                $modelDirection = new Direction();
                $modelDirection->cypher = $cypherPlan;
                $modelDirection->name_direction = $dirplan;
                $modelDirection->save();
            }
            
//Добавление профиля подготовки если нет такого
            if (!$modelSpesiality = Spesiality::find()
                    ->where(["name_spesiality" => $spesialityPlan])
                    ->one()){
                $modelSpesiality = new Spesiality();
                $modelSpesiality->name_spesiality = $spesialityPlan;
                $modelSpesiality->direction_id = $modelDirection->id;
                $modelSpesiality->save();
            }
                      
//Добавление корректного уровня подготовки
            if ($infall[2] == 'магистра')
                    $level = 'Магистр';
            
            if ($infall[2] == 'бакалавра')
                    $level = 'Бакалавр'; 

            if (!$modelPlan = Plan::find()
                    ->where(['plan_number' => $infall[0]])
                    ->one()){
            $modelPlan = new Plan();
            $modelPlan->plan_number = $infall[0];
            $modelPlan->level_of_training = $level;
            $modelPlan->form_of_training = trim($infall[11], '.');
            $modelPlan->spesiality_id = $modelSpesiality->id;
            $modelPlan->year = $infall[16];
            $modelPlan->save();
            } else {
                SubjectsInfo::deleteAll(['plan_id' =>$modelPlan->id]);
                }
            
            $semestr = 0;
            
            foreach ($sheetNames as $key => $tableIndex ){
            
                $semestr = ++$semestr;
                $objectPhpExcel->setActiveSheetIndexByName($tableIndex);
                $bodyData = $objectPhpExcel->getActiveSheet()->toArray(null, true, true, true);
                //var_dump('semestr', $semestr);
               // var_dump($bodyData);
                
                foreach ($bodyData as $key => $dataRow) {
                    
                    $planSub = array_filter($dataRow);
                    //var_dump($planSub);
                    $planS = str_replace(array ("\r\n", "\r", "\n"), " ", $planSub);
                    //var_dump($planS);
                    
                    foreach (\common\models\SubjectsInfo::$planInfoTitles as $k => $planInfoTitle)
                    {
                        if ($value = array_search($planInfoTitle, $planS)) {
                            $planKeySub [$k]= $value;
                        }
                    }
                    
                        
                    if (is_numeric($dataRow['B'])){
                        
                        //var_dump($planKeySub);
                        
                        $prev = $bodyData[$key-1];
                        
// Поиск шифра части и цикла
                        if ($prev['B'] == NULL){
                        $previ = $prev['A'];
                        $partInf = explode(" ", $previ);
                    
                        
                        $numericString = preg_replace('/[^0-9.]/', ' ', $previ);
                        $partInf = explode(" ", $numericString); 
                        $partInf = array_diff($partInf, ['']);
                    
                        foreach ($partInf as &$partInfPart) {
                            $partInfPart = trim($partInfPart, '.');
                        }
                                                   
                        if ($modelPartCycle = PartCycle::find()
                            ->where(['like', "id_cycle", $partInfPart])
                            ->one()){
                        $partId = $modelPartCycle->id;

                        } else if ($modelPartCycle = PartCycle::find()
                            ->where(['like', "id_subcycle", $partInfPart])
                            ->one()){
                            $partId = $modelPartCycle->id;
                        }
                        
                        }
                    
////Добавление дисциплины в subjects если такой нет
                    if (!$modelSubject = Subjects::find()
                        ->where(["name_subject" => $dataRow["C"]])
                        ->one()){
                    $modelSubject = new Subjects();
                    $modelSubject->name_subject = $dataRow["C"];
                    $modelSubject->save();
                    }
                    
                    $planId = $modelPlan->id;
                    $subjectId = $modelSubject->id;
                    
                    //var_dump($planSub);
                    
                    
                            $modelSubjectInfo = new SubjectsInfo();
                            $modelSubjectInfo->subjects_id = $subjectId;
                            $modelSubjectInfo->plan_id = $planId;
                            $modelSubjectInfo->part_cycle_id = $partId;
                            $modelSubjectInfo->semestr = $semestr;
                            foreach ($planKeySub as $itemkey => $item) {
                                if (isset($planSub[$item])) {
                                   $modelSubjectInfo->$itemkey = is_numeric($planSub[$item]) ? $planSub[$item] : 1; 
                                } else {
                                    $modelSubjectInfo->$itemkey = 0;
                                }
                            }
                            $modelSubjectInfo->save();
                        
                            
                    
                    
                }

                }
                
            

                       
            }
            //exit();

        
    }
    
    }
        
    
}
	