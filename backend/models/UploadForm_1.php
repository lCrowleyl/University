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

    public function importPlanTitle($file) {

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

            $inf = implode(" ", $headIn);
            $infdop = explode("№", $inf);
            $infall = explode(" ", $infdop[1]);
            $a = $infall[5];
            $a = trim($a);
            $infCypher = explode(" ", $a);
            $dirplan1 = array_slice($infCypher, 1, count($infCypher));
            $cypherPlan = $infCypher[0];
            $dirplan = implode(" ", $dirplan1);
            $spesialityPlan = $infall[8];

            //Добавление направления если нет такого шифра
            if (!$modelDirection = Direction::find()
                    ->where(["cypher" => $cypherPlan])
                    ->one()) {
                $modelDirection = new Direction();
                $modelDirection->cypher = $cypherPlan;
                $modelDirection->name_direction = $dirplan;
                $modelDirection->save();
            }

            //Добавление профиля подготовки если нет такого
            if (!$modelSpesiality = Spesiality::find()
                    ->where(["name_spesiality" => $spesialityPlan])
                    ->one()) {
                $modelSpesiality = new Spesiality();
                $modelSpesiality->name_spesiality = $spesialityPlan;
                $modelSpesiality->direction_id = $modelDirection->id;
                $modelSpesiality->save();
            }

            //Добавление корректного уровня подготовки
            if ($infall[2] == 'магистра')
                $level = 'магистр';

            if ($infall[2] == 'бакалавра')
                $level = 'бакалавр';

            if (!$modelPlan = Plan::find()
                    ->where(['plan_number' => $infall[0]])
                    ->one()) {
                $modelPlan = new Plan();
                $modelPlan->plan_number = $infall[0];
                $modelPlan->level_of_training = $level;
                $modelPlan->form_of_training = trim($infall[11], '.');
                $modelPlan->spesiality_id = $modelSpesiality->id;
                $modelPlan->year = $infall[16];
                $modelPlan->save();
            } else {
                SubjectsInfo::deleteAll(['plan_id' => $modelPlan->id]);
            }

            $semestr = 0;

            foreach ($sheetNames as $key => $tableIndex) {

                $semestr = ++$semestr;
                $objectPhpExcel->setActiveSheetIndexByName($tableIndex);
                $bodyData = $objectPhpExcel->getActiveSheet()->toArray(null, true, true, true);

                foreach ($bodyData as $key => $dataRow) {
                    if (is_numeric($dataRow['B'])) {
                        $prev = $bodyData[$key - 1];
                        if ($prev['B'] == NULL) {
                            $previ = $prev['A'];
                            $partInf = explode(" ", $previ);

                            // Поиск шифра части и цикла
                            $numericString = preg_replace('/[^0-9.]/', ' ', $previ);
                            $partInf = explode(" ", $numericString);
                            $partInf = array_diff($partInf, ['']);

                            foreach ($partInf as &$partInfPart) {
                                $partInfPart = trim($partInfPart, '.');
                            }

                            if ($modelPartCycle = PartCycle::find()
                                    ->where(['like', "id_cycle", $partInfPart])
                                    ->one()) {
                                $partId = $modelPartCycle->id;
                            } else if ($modelPartCycle = PartCycle::find()
                                    ->where(['like', "id_subcycle", $partInfPart])
                                    ->one()) {
                                $partId = $modelPartCycle->id;
                            }
                        }

                        //Добавление дисциплины в subjects если такой нет
                        if (!$modelSubject = Subjects::find()
                                ->where(["name_subject" => $dataRow["C"]])
                                ->one()) {
                            $modelSubject = new Subjects();
                            $modelSubject->name_subject = $dataRow["C"];
                            $modelSubject->save();
                        }

                        $planId = $modelPlan->id;
                        $subjectId = $modelSubject->id;

                        if (!is_null($dataRow['H']))
                            $dataRow['H'] = 1;

                        if (!is_null($dataRow['I']))
                            $dataRow['I'] = 1;

                        if (!is_null($dataRow['J']))
                            $dataRow['J'] = 1;

                        if (!is_null($dataRow['L']))
                            $dataRow['L'] = 1;

                        if (!is_null($dataRow['N']))
                            $dataRow['N'] = 1;

                        $modelSubjectInfo = new SubjectsInfo();
                        $modelSubjectInfo->subjects_id = $subjectId;
                        $modelSubjectInfo->plan_id = $planId;
                        $modelSubjectInfo->part_cycle_id = $partId;
                        $modelSubjectInfo->semestr = $semestr;

                        $modelSubjectInfo->lecture_time = $dataRow["Q"];
                        $modelSubjectInfo->labs_time = $dataRow["R"];
                        $modelSubjectInfo->practical_time = $dataRow["S"];

                        $modelSubjectInfo->exam = $dataRow["H"];
                        $modelSubjectInfo->credit = $dataRow["I"];
                        $modelSubjectInfo->differentiated_credit = $dataRow["J"];

                        $modelSubjectInfo->cource_work = $dataRow["L"];
                        $modelSubjectInfo->cource_project = $dataRow["N"];
                        $modelSubjectInfo->individual_assignment = $dataRow["P"];

                        $modelSubjectInfo->summ_time = $dataRow["X"];
                        $modelSubjectInfo->save();
                    }
                }
            }
        }
    }

}
