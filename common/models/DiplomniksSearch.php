<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Diplomniks;

/**
 * DiplomniksSearch represents the model behind the search form about `common\models\Diplomniks`.
 */
class DiplomniksSearch extends Diplomniks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'teachers_id', 'flow_id', 'count'], 'integer'],
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
        $query = Diplomniks::find();

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
            'teachers_id' => $this->teachers_id,
            'flow_id' => $this->flow_id,
            'count' => $this->count,
        ]);

        return $dataProvider;
    }
}
