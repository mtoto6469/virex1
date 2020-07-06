<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Factor;

/**
 * FactorSearch represents the model behind the search form of `frontend\models\Factor`.
 */
class FactorSearch extends Factor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_exhibition', 'id_room', 'id_company', 'id_user', 'id_participant', 'volume', 'id_advertise', 'price', 'visible', 'print', 'endPrice', 'enable', 'buyAdvertise'], 'integer'],
            [['date', 'date_ir', 'time', 'time_ir', 'atu', 'ref'], 'safe'],
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
        $query = Factor::find();

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
            'id_exhibition' => $this->id_exhibition,
            'id_room' => $this->id_room,
            'id_company' => $this->id_company,
            'id_user' => $this->id_user,
            'id_participant' => $this->id_participant,
            'volume' => $this->volume,
            'id_advertise' => $this->id_advertise,
            'price' => $this->price,
            'date' => $this->date,
            'time' => $this->time,
            'visible' => $this->visible,
            'print' => $this->print,
            'endPrice' => $this->endPrice,
            'enable' => $this->enable,
            'buyAdvertise' => $this->buyAdvertise,
        ]);

        $query->andFilterWhere(['like', 'date_ir', $this->date_ir])
            ->andFilterWhere(['like', 'time_ir', $this->time_ir])
            ->andFilterWhere(['like', 'atu', $this->atu])
            ->andFilterWhere(['like', 'ref', $this->ref]);

        return $dataProvider;
    }
}
