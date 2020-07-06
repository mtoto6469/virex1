<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Factoradvertise;

/**
 * FactoradvertiseSearch represents the model behind the search form of `frontend\models\Factoradvertise`.
 */
class FactoradvertiseSearch extends Factoradvertise
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'volume', 'advertise','id_user' ,'id_participant', 'price', 'visible', 'print', 'confirm', 'endPrice', 'enable'], 'integer'],
            [['atu', 'ref', 'date', 'date_ir', 'time', 'addressOfCentralOffice', 'factoryAddress'], 'safe'],
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
        $query = Factoradvertise::find();

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
            'volume' => $this->volume,
            'advertise' => $this->advertise,
            'id_user' => $this->id_user,
            'id_participant' => $this->id_participant,
            'price' => $this->price,
            'visible' => $this->visible,
            'print' => $this->print,
            'date' => $this->date,
            'time' => $this->time,
            'confirm' => $this->confirm,
            'endPrice' => $this->endPrice,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'atu', $this->atu])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'date_ir', $this->date_ir])
            ->andFilterWhere(['like', 'addressOfCentralOffice', $this->addressOfCentralOffice])
            ->andFilterWhere(['like', 'factoryAddress', $this->factoryAddress]);

        return $dataProvider;
    }
}
