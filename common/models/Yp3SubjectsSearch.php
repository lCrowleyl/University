<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Yp3Subjects;

/**
 * Yp3SubjectsSearch represents the model behind the search form about `common\models\Yp3Subjects`.
 */
class Yp3SubjectsSearch extends Yp3Subjects
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subjects_info_id', 'yp3_id', 'flows_id', 'count_week', 'semestr'], 'integer'],
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
        $query = Yp3Subjects::find();

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
            'subjects_info_id' => $this->subjects_info_id,
            'yp3_id' => $this->yp3_id,
            'flows_id' => $this->flows_id,
            'count_week' => $this->count_week,
            'semestr' => $this->semestr,
        ]);

        return $dataProvider;
    }
}
