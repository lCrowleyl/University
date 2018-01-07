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
class UploadForm extends Model {

    /**
     * @var UploadedFile
     */
    const HEADT = 7;
    const FACULTYZ = 'ИИТЗО';
    const FACULTY = 'ФКНТ';
    const NAMEPLAN = 'Учебный план:';
    const FACULTYNAME = 'Факультет:';
    const DIRECTION = 'Направление:';
    const SPESIALITY = 'Профиль';

    public $exelFile;

    public function rules() {
        return [
            [['exelFile'], 'file', 'skipOnEmpty' => false,],
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $this->importPlanTitle($this->exelFile);
            return true;
        } else {
            return false;
        }
    }

    /** Adding a training direction if there is no such
     * 
     * @param   string  $cypherDir  Number add cypher direction
     * @param   string  $dirPlan    Name add direction
     * 
     * @return  int Id saved direction 
     */
    public function addDirection($cypherDir, $dirPlan) {
        if (!$modelDirection = Direction::find()
                ->where(["cypher" => $cypherDir])
                ->one()
        ) {
            $modelDirection = new Direction();
            $modelDirection->cypher = $cypherDir;
            $modelDirection->name_direction = $dirPlan;
            $modelDirection->save();
        }
        $directionId = $modelDirection->id;
        return $directionId;
    }

    /** Adding a training profile if there is no such
     * 
     * @param   string  $nameSpesiality Name specialty 
     * @param   string  $directionId    Id direction 
     * 
     * @return  int Id saved specialty 
     */
    public function addSpeciality($nameSpesiality, $directionId) {
        if (!$modelSpesiality = Spesiality::find()
                ->where(["name_spesiality" => $nameSpesiality])
                ->one()
        ) {
            $modelSpesiality = new Spesiality();
            $modelSpesiality->name_spesiality = $nameSpesiality;
            $modelSpesiality->direction_id = $directionId;
            $modelSpesiality->save();
        }
        $spesialityId = $modelSpesiality->id;
        return $spesialityId;
    }

    /** Adding a curriculum
     * 
     * @param   int     $numberPlan     Number add plan
     * @param   string  $level          Level of training
     * @param   int     $yearPlan  
     * @param   string  $training       Form of training
     * @param   int     $spesialityId   ID of the specialty corresponding 
     *                                  to the plan
     * 
     * @return  int Id saved plan 
     */
    public function addPlan($numberPlan, $level, $yearPlan, $training, $spesialityId) {
        if (!$modelPlan = Plan::find()
                ->where(['plan_number' => $numberPlan])
                ->one()
        ) {
            $modelPlan = new Plan();
            $modelPlan->plan_number = $numberPlan;
            $modelPlan->level_of_training = $level;
            $modelPlan->form_of_training = $training;
            $modelPlan->spesiality_id = $spesialityId;
            $modelPlan->year = $yearPlan;
            $modelPlan->save();
        } else {
            SubjectsInfo::deleteAll(['plan_id' => $modelPlan->id]);
        }
        $planId = $modelPlan->id;
        return $planId;
    }

    /** Adding discipline or changing the subjects
     * 
     * @param   string      $nameSubj     Name add subject
     * @param   string      $department   Name of department
     * 
     * @return  int Id saved subject 
     */
    public function addSubjects($nameSubj, $department) {
        if (!$modelSubject = Subjects::find()
                ->where(["name_subject" => $nameSubj])
                ->one()
        ) {
            $modelSubject = new Subjects();
            $modelSubject->name_subject = $nameSubj;
            if ($department == "АСУ") {
                $modelSubject->is_self = 1;
                $modelSubject->faculty = self::FACULTY;
            }
            $modelSubject->save();
        }
        $subjectsId = $modelSubject->id;
        return $subjectsId;
    }

    /** Adding discipline according to plan
     * 
     * @param   array   $dataRows   Line with subject info
     * @param   int     $semestr    Number semester
     * @param   int     $planId     Id plan
     * 
     * @return  
     */
    public function addSubjectPlan($dataRows, $semestr, $planId, $partCycle) {
        $time = explode("/", $dataRows['S']);
        $modelSubjectInfo = new SubjectsInfo();
        $modelSubjectInfo->subjects_id = $this->addSubjects($dataRows['B'], $dataRows['U']);
        $modelSubjectInfo->plan_id = $planId;
        $modelSubjectInfo->part_cycle_id = $partCycle;
        $modelSubjectInfo->semestr = $semestr;
        $modelSubjectInfo->lecture_time = $dataRows['K'];
        $modelSubjectInfo->labs_time = $dataRows['L'];
        $modelSubjectInfo->practical_time = $dataRows['M'];
        $modelSubjectInfo->exam = $dataRows['D'];
        $modelSubjectInfo->credit = $dataRows['E'];
        $modelSubjectInfo->differentiated_credit = $dataRows['F'];
        $modelSubjectInfo->cource_work = $dataRows['H'];
        $modelSubjectInfo->cource_project = $dataRows['J'];
        $modelSubjectInfo->individual_assignment = $dataRows['J'];
        $modelSubjectInfo->summ_time = $time[0];
        $modelSubjectInfo->save();
    }

    /** Get Head table
     * 
     * @param   array   $facultyRow      Line with information
     * 
     * @return  string              Information about head
     */
    public function changeFaculty($facultyRow) {
        if ($facultyRow[0] == self::FACULTYZ) {
            $training = "Заочная";
        } elseif ($facultyRow[0] == self::FACULTY) {
            $training = "Очная";
        }
        return $training;
    }

    /** Get Head table
     * 
     * @param   array   $dataR      Line with information
     * 
     * @return  string              Information about head
     */
    public function getHead($dataR) {
        if (stristr($dataR[0], self::FACULTYNAME)) {
            $facultyRow = explode(" ", $dataR['1']);
            $training = $this->changeFaculty($facultyRow);
            return $training;
        }
        if (stristr($dataR[0], self::SPESIALITY)) {
            $spesialityRow = explode(" ", $dataR['1']);
            unset($spesialityRow[0]);
            $nameSpesiality = implode(" ", $spesialityRow);
            return $nameSpesiality;
        }
        if (stristr($dataR[0], self::NAMEPLAN)) {
            return $dataR['1'];
        }
        if (stristr($dataR[0], self::DIRECTION)) {
            $directionRow = explode(" ", $dataR['1']);
            $cypherDir = $directionRow[0];
            return $cypherDir;
        }
    }

    /** Get Year plan
     * 
     * @param   array   $dataR   Line with faculty
     * 
     * @return  string  Year of plan
     */
    public function getYearPlan($dataR) {
        if (stristr($dataR[0], self::FACULTYNAME)) {
            return $dataR[5];
        }
    }

    /** Get level of training
     * 
     * @param   array   $dataR   Line with faculty
     * 
     * @return  string  Level of training
     */
    public function getLevel($dataR) {
        if (stristr($dataR[0], self::FACULTYNAME)) {
            return $dataR[3];
        }
    }

    /** Get Direction Plan
     * 
     * @param   array   $dataR   Line with Direction
     * 
     * @return  string  Name Direction
     */
    public function getDirPlan($dataR) {
        if (stristr($dataR[0], self::DIRECTION)) {
            $directionRow = explode(" ", $dataR['1']);
            unset($directionRow[0]);
            $dirPlan = implode(" ", $directionRow);
            return $dirPlan;
        }
    }

    /** Get Number semester
     * 
     * @param   array   $dataRows   Line with Semester
     * 
     * @return  int  Number 
     */
    public function getNumSem($dataRows) {
        if (strlen($dataRows['A']) > "5" and strlen($dataRows['A']) < "18") {
            $semestrRow = explode(" ", $dataRows['A']);
            return $semestrRow[0];
        }
    }

    /** Get Part Cycle
     * 
     * @param   array   $dataRows   Line with Part
     * 
     * @return  int  id Cycle 
     */
    public function getPartCycle($dataRows) {
        if (strlen($dataRows['A']) > 30) {
            $numericString = preg_replace('/[^0-9.]/', ' ', $dataRows['A']);
            $partInf = explode(" ", $numericString);
            $partInfo = array_diff($partInf, ['']);
            foreach ($partInfo as &$partInfPart) {
                $partInfPart = trim($partInfPart, '.');
            }
            $partInfos = array_values($partInfo);
            $partId = $this->cycleDefinition($partInfos);
            return $partId;
        }
    }

    /** Cycle definition
     * 
     * @param   array   $partInfo   Information about cycle
     * 
     * @return  int  Id cycle 
     */
    public function cycleDefinition($partInfo) {
        switch (sizeof($partInfo)) {
            case 1:
                if ($modelPartCycle = PartCycle::find()
                        ->where(['like', "id_cycle", $partInfo[0]])
                        ->one()) {
                    $partId = $modelPartCycle->id;
                }
                break;
            case 2:
                if ($modelPartCycle = PartCycle::find()
                        ->where(['like', "id_cycle", $partInfo[1]])
                        ->one()) {
                    $partId = $modelPartCycle->id;
                }
                break;
            case 4:
                if ($modelPartCycle = PartCycle::find()
                        ->where(['like', "id_subcycle", $partInfo[3]])
                        ->one()) {
                    $partId = $modelPartCycle->id;
                }
                break;
        }
        return $partId;
    }

    public function importPlanTitle($file) {
        $format = \PHPExcel_IOFactory::identify($file->tempName);
        $objectreader = \PHPExcel_IOFactory::createReader($format);
        $objectPhpExcel = $objectreader->load($file->tempName);
        $sheetNames = $objectPhpExcel->getSheetNames();
        $headName = array_shift($sheetNames);
        $objectPhpExcel->setActiveSheetIndexByName($headName);
        $headData = $objectPhpExcel->getActiveSheet()->toArray(null, true, true, true);
        foreach ($headData as $key => $dataRows) {
            $dataRow = array_filter($dataRows);
            if ($key < self::HEADT) {
                $dataR = array_values($dataRow);
                $numberPlan = $this->getHead($dataR) ?: (isset($numberPlan) ? $numberPlan : false);
                $level = $this->getYearPlan($dataR) ?: (isset($level) ? $level : false);
                $yearPlan = $this->getYearPlan($dataR) ?: (isset($yearPlan) ? $yearPlan : false);
                $training = $this->getHead($dataR) ?: (isset($training) ? $training : false);
                $dirPlan = $this->getDirPlan($dataR) ?: (isset($dirPlan) ? $dirPlan : false);
                $cypherDir = $this->getHead($dataR) ?: (isset($cypherDir) ? $cypherDir : false);
                $nameSpesiality = $this->getHead($dataR) ?: (isset($nameSpesiality) ? $nameSpesiality : false);
            }
        }
        $directionId = $this->addDirection($cypherDir, $dirPlan);
        $spesialityId = $this->addSpeciality($nameSpesiality, $directionId);
        $planId = $this->addPlan($numberPlan, $level, $yearPlan, $training, $spesialityId);
        if ($key > self::HEADT) {
            $semestr = $this->getNumSem($dataRows) ?: (isset($semestr) ? $semestr : false);
            $partCycle = $this->getPartCycle($dataRows) ?: (isset($partCycle) ? $partCycle : false);
            if (is_numeric($dataRows['A'])) {
                $this->addSubjectPlan($dataRows, $semestr, $planId, $partCycle);
            }
        }
//        exit();
    }
}
