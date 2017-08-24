<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SubjectsInfo;

/**
 * SubjectsInfoSearch represents the model behind the search form about `common\models\SubjectsInfo`.
 */
class SubjectsInfoSearch extends SubjectsInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subjects_id', 'plan_id', 'part_cycle_id', 'semestr', 'status', 'lecture_time', 'labs_time', 'practical_time', 'exam', 'credit', 'differentiated_credit', 'cource_work', 'cource_project', 'individual_assignment', 'summ_time'], 'safe'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SubjectsInfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'subjects_id' => $this->subjects_id,
            'plan_id' => $this->plan_id,
            'part_cycle_id' => $this->part_cycle_id,
            'semestr' => $this->semestr,
            'status' => $this->status,
            'lecture_time' => $this->lecture_time,
            'labs_time' => $this->labs_time,
            'practical_time' => $this->practical_time,
            'exam' => $this->exam,
            'credit' => $this->credit,
            'differentiated_credit' => $this->differentiated_credit,
            'cource_work' => $this->cource_work,
            'cource_project' => $this->cource_project,
            'individual_assignment' => $this->individual_assignment,
            'summ_time' => $this->summ_time,
        ]);

        return $dataProvider;
    }
}
