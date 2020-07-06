<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Myrules;

/**
 * MyrulesSearch represents the model behind the search form of `frontend\models\myrules`.
 */
class MyrulesSearch extends Myrules
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'enable'], 'integer'],
            [['address', 'phone1', 'phone2', 'fax', 'mobile1', 'mobile2', 'guide1', 'guide2', 'rules', 'exhibitTariffs', 'abouteUs'], 'safe'],
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
        $query = Myrules::find();

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
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone1', $this->phone1])
            ->andFilterWhere(['like', 'phone2', $this->phone2])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'mobile1', $this->mobile1])
            ->andFilterWhere(['like', 'mobile2', $this->mobile2])
            ->andFilterWhere(['like', 'guide1', $this->guide1])
            ->andFilterWhere(['like', 'guide2', $this->guide2])
            ->andFilterWhere(['like', 'rules', $this->rules])
            ->andFilterWhere(['like', 'exhibitTariffs', $this->exhibitTariffs])
            ->andFilterWhere(['like', 'abouteUs', $this->abouteUs]);

        return $dataProvider;
    }
}
