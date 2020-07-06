<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Country;

/**
 * CountrySearch represents the model behind the search form of `backend\models\Country`.
 */
class CountrySearch extends Country
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'enable','id_img'], 'integer'],
            [['country_name'], 'safe'],
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
        $query = Country::find()->where(['enable'=>1]);

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
            'id_img'=>$this->id_img,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'country_name', $this->country_name]);

        return $dataProvider;
    }
}
