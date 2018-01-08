<?php

namespace backend\controllers;

use Yii;
use common\models\Yp3;
use common\models\Yp3Search;
use common\models\Yp4Subjects;
use common\models\Yp3Subjects;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\YPUploadForm;
use yii\web\UploadedFile;

/**
 * Yp3Controller implements the CRUD actions for Yp3 model.
 */
class Yp3Controller extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Yp3 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Yp3Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Yp3 model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $q = Yp3Subjects::find()->where(['yp3_id' => $id])->andWhere(['!=', 'all', 0]);
        $yp3Dp = new \yii\data\ActiveDataProvider(['query' => $q]);
        $q = \common\models\Yp4Subjects::find()
                ->leftJoin('yp3_subjects', 'yp3_subjects.id=yp4_subjects.yp_subjects_id') 
                ->leftJoin('yp3', 'yp3_subjects.yp3_id=yp3.id')->where(['yp3_subjects.yp3_id' => $id]);
        $yp4Dp = new \yii\data\ActiveDataProvider(['query' => $q]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'yp3Dp' => $yp3Dp,
            'yp4Dp' => $yp4Dp,
        ]);
    }
    
    public function actionPlan($id, $teachers_id, $semestr=1)
    {
//       $q = \common\models\Yp4Subjects::find()
//                ->select('subjects_info_id, flows_id')
//                ->leftJoin('yp3_subjects', 'yp3_subjects.id=yp4_subjects.yp_subjects_id') 
//                ->leftJoin('yp3', 'yp3_subjects.yp3_id=yp3.id')->where(['yp3_subjects.yp3_id' => $id])
//                ->groupBy(['subjects_info_id', 'flows_id']);
//        
        $q = \common\models\Yp4Subjects::find()
                ->select('MIN(yp4_subjects.id) as id, yp4_subjects.subjects_info_id, yp4_subjects.flows_id, '
                        . 'SUM(yp4_subjects.lections) as lections,'
                        . 'SUM(yp4_subjects.pract) as pract,'
                        . 'SUM(yp4_subjects.labs) as labs,'
                        . 'SUM(yp4_subjects.nirs) as nirs,'
                        . 'SUM(yp4_subjects.kontz_zao) as kontz_zao,'
                        . 'SUM(yp4_subjects.kons) as kons,'
                        . 'SUM(yp4_subjects.ekzam_kons) as ekzam_kons,'
                        . 'SUM(yp4_subjects.kontr) as kontr,'
                        . 'SUM(yp4_subjects.kyrs) as kyrs,'
                        . 'SUM(yp4_subjects.zach) as zach,'
                        . 'SUM(yp4_subjects.eczam) as eczam,'
                        . 'SUM(yp4_subjects.practic) as practic,'
                        . 'SUM(yp4_subjects.recen) as recen,'
                        . 'SUM(yp4_subjects.dr) as dr, yp4_subjects.teachers_id, MIN(yp4_subjects.yp_subjects_id)')
                ->leftJoin('yp3_subjects', 'yp3_subjects.id=yp4_subjects.yp_subjects_id') 
                ->leftJoin('yp3', 'yp3_subjects.yp3_id=yp3.id')->where(['yp3_subjects.yp3_id' => $id])
              //  ->andWhere(['yp3_subjects.semestr' => $semestr])
                ->groupBy(['subjects_info_id', 'flows_id', 'teachers_id', 'yp3_subjects.semestr'])->orderBy([
  'teachers_id' => SORT_ASC,
   'yp3_subjects.semestr' =>     SORT_ASC,             
  'id'=>SORT_ASC
]);
        $yp4Dp = new \yii\data\ActiveDataProvider(['query' => $q]);
        return $this->render('plan', [
            'yp4Dp' => $yp4Dp,
            'id' => $id,
            'teachers_id' => $teachers_id,
            'semestr' => $semestr,
        ]);
    }

    /**
     * Creates a new Yp3 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Yp3();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Yp3 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model =  Yp3Subjects::findOne($id);
        $yp4 = new Yp4Subjects;
        $yp4->subjects_info_id = $model->subjects_info_id;
        $yp4->flows_id = $model->flows_id;
        $yp4->count_week = $model->count_week;
        $yp4->yp_subjects_id = $model->id;
        if ($yp4->load(Yii::$app->request->post()) ) {
            if ($yp4->teachers_ids) {
                foreach ($yp4->teachers_ids as $teachers_id) {
                    $item  = new Yp4Subjects;
                    $item->subjects_info_id = $model->subjects_info_id;
                    $item->flows_id = $model->flows_id;
                    $item->count_week = $model->count_week;
                    $item->yp_subjects_id = $model->id;
                    $item->teachers_id = $teachers_id;
                    if ($model->nirs) {
                        $item->nirs = $yp4->count;
                        $model->nirs = $model->nirs - $yp4->count;
                        $model->all = $model->all - $yp4->count;
                        
                    }
                    if ($model->practic) {
                        $item->practic = $yp4->count;
                        $model->practic = $model->practic - $yp4->count;
                        $model->all = $model->all - $yp4->count;
                        
                    }
                    if ($model->recen) {
                        $item->recen = $yp4->count;
                        $model->recen = $model->recen - $yp4->count;
                        $model->all = $model->all - $yp4->count;
                        
                    }
                     if ($model->dr) {
                        $item->dr = $yp4->count;
                        $model->dr = $model->dr - $yp4->count;
                        $model->all = $model->all - $yp4->count;
                        
                    }
                    $item->save(false);
                    $model->save(false);
                }
            }
            return $this->redirect(['view', 'id' => $model->yp3_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'yp4' => $yp4,
            ]);
        }
    }

    /**
     * Deletes an existing Yp3 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Yp3 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Yp3 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Yp3::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
        public function actionUpload()
    {
        $modelUp = new \backend\models\YPUploadForm();

        if (Yii::$app->request->isPost) {
            $modelUp->exelFile = UploadedFile::getInstance($modelUp, 'exelFile');
            if ($modelUp->upload()) {
                // file is uploaded successfully
                return $this->redirect('index');
            }
        }

        return $this->render('upload', ['model' => $modelUp]);
    }
    
    public function actionGenerate($id)
    {
        $model = $this->findModel($id);
        $subjects = $model->yp3Subjects; 
        foreach ($subjects as $subject) {
            if ($subject->lections || $subject->ekzam_kons || $subject->kons) {
                $yp4 = new \common\models\Yp4Subjects;
                $yp4->subjects_info_id = $subject->subjects_info_id;
                $yp4->lections = $subject->lections;
                $subject->lections = 0;
                $yp4->kons = $subject->kons;
                $subject->kons = 0;
                $yp4->ekzam_kons = $subject->ekzam_kons;
                $subject->ekzam_kons = 0;
                $yp4->eczam = $subject->eczam;
                $subject->eczam = 0;
                $subject->all = $subject->all - $yp4->lections -  $yp4->kons -  $yp4->ekzam_kons - $yp4->eczam;
                $subject->save(false);
                $yp4->flows_id = $subject->flows_id;
                $yp4->count_week = $subject->count_week;
                $yp4->yp_subjects_id = $subject->id;
                $yp4->save(false);
            }
            if ($subject->labs) {
                $subGroups = $subject->flows->small_groups;
                for ($i=0; $i < $subGroups; $i++ ) {
                    $yp4 = new \common\models\Yp4Subjects;
                    $yp4->subjects_info_id = $subject->subjects_info_id;
                    $yp4->labs = $subject->labs / $subGroups;
                    $yp4->kontz_zao = $subject->kontz_zao / $subGroups;
                    $yp4->kontr = $subject->kontr / $subGroups;
                    $yp4->zach = $subject->zach / $subGroups;
                    $yp4->flows_id = $subject->flows_id;
                    $yp4->count_week = $subject->count_week;
                    $yp4->yp_subjects_id = $subject->id;
                    $yp4->save(false);
                }
                $subject->all =   $subject->all - $subject->labs -$subject->kontz_zao- $subject->kontr- $subject->zach;
                $subject->labs = 0;
                $subject->kontz_zao = 0;
                $subject->kontr = 0;
                $subject->zach = 0;
                $subject->save(false);
            }
            if ($subject->pract) {
                $yp4 = new \common\models\Yp4Subjects;
                $yp4->subjects_info_id = $subject->subjects_info_id;
                $yp4->pract = $subject->pract;
                $yp4->kontz_zao = $subject->kontz_zao ;
                $yp4->kontr = $subject->kontr;
                $yp4->zach = $subject->zach;
                $yp4->flows_id = $subject->flows_id;
                $yp4->count_week = $subject->count_week;
                $yp4->yp_subjects_id = $subject->id;
                $yp4->save(false);
                $subject->all =   $subject->all - $subject->pract-$subject->kontz_zao- $subject->kontr- $subject->zach;;
                $subject->pract = 0;
                $subject->save(false);
            }
            if ($subject->kyrs) {
                $subGroups = $subject->flows->small_groups;
                for ($i=0; $i < $subGroups; $i++ ) {
                    $yp4 = new \common\models\Yp4Subjects;
                    $yp4->subjects_info_id = $subject->subjects_info_id;
                    $yp4->kyrs = $subject->kyrs / $subGroups;
                    $yp4->flows_id = $subject->flows_id;
                    $yp4->count_week = $subject->count_week;
                    $yp4->yp_subjects_id = $subject->id;
                    $yp4->save(false);
                }
                $subject->all =   $subject->all - $subject->kyrs;
                $subject->kyrs = 0;
                $subject->save(false);
            }
        }
    }
    
    
    public function actionTimetable($id, $teachers_id, $semestr=1)
    {
        $q = \common\models\Yp4Subjects::find()
                ->leftJoin('yp3_subjects', 'yp3_subjects.id=yp4_subjects.yp_subjects_id') 
                ->leftJoin('yp3', 'yp3_subjects.yp3_id=yp3.id')
                ->where(['yp3_subjects.yp3_id' => $id])
                ->andWhere(['yp3_subjects.semestr' => $semestr])
                ->orderBy([
                    'teachers_id' => SORT_ASC,
                     'yp3_subjects.semestr' =>     SORT_ASC,             
                    'id'=>SORT_ASC
                ]);
        $yp4Dp = new \yii\data\ActiveDataProvider(['query' => $q]);
        return $this->render('timetable', [
            'yp4Dp' => $yp4Dp,
            'id' => $id,
            'teachers_id' => $teachers_id,
            'semestr' => $semestr,
        ]);
    }

    public function actionSetyp4pr($id, $user_id) {
        $model = Yp4Subjects::find()->where(['id' => $id])->one();
        $model->teachers_id = $user_id;
        $model->save(false);
    }
}
