<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Productmove;

/**
 * ProductmoveSearch represents the model behind the search form of `backend\models\Productmove`.
 */
class ProductmoveSearch extends Productmove
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_product', 'enable'], 'integer'],
            [['move1', 'move2', 'move3', 'move4','alt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Productmove::find();

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
            'id_product' => $this->id_product,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'alt', $this->alt])
            ->andFilterWhere(['like', 'move1', $this->move1])
            ->andFilterWhere(['like', 'move2', $this->move2])
            ->andFilterWhere(['like', 'move3', $this->move3])
            ->andFilterWhere(['like', 'move4', $this->move4]);

        return $dataProvider;
    }
}
