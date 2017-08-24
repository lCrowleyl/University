<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PartCycle;

/**
 * PartCycleSearch represents the model behind the search form about `common\models\PartCycle`.
 */
class PartCycleSearch extends PartCycle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_part'], 'integer'],
            [['name_part', 'name_cycle', 'name_subcycle', 'id_subcycle'], 'safe'],
            [['id_cycle'], 'number'],
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
        $query = PartCycle::find();

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
            'id_part' => $this->id_part,
            'id_cycle' => $this->id_cycle,
            'id_subcycle' => $this->id_subcycle,
        ]);

        $query->andFilterWhere(['like', 'name_part', $this->name_part])
            ->andFilterWhere(['like', 'name_cycle', $this->name_cycle])
            ->andFilterWhere(['like', 'name_subcycle', $this->name_subcycle]);

        return $dataProvider;
    }
}
