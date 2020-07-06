<?php

namespace backend\models;

use frontend\models\Country;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Exhibitionn;

/**
 * ExhibitionnSearch represents the model behind the search form of `backend\models\Exhibitionn`.
 */
class ExhibitionnSearch extends Exhibitionn
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'image', 'enable'], 'integer'],
            [['title', 'holding_date', 'holding_date_ir', 'completion_date', 'completion_date_ir', 'holding_time','id_country',  'completion_time'], 'safe'],
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
        $query = Exhibitionn::find()->where(['enable'=>1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $query->joinWith('idcountry')->where([Exhibitionn::tableName().'.enable'=>1]);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'id_country' => $this->id_country,
            'holding_date' => $this->holding_date,
            'completion_date' => $this->completion_date,
            'holding_time' => $this->holding_time,
            'completion_time' => $this->completion_time,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'holding_date_ir', $this->holding_date_ir])
            ->andFilterWhere(['like', 'completion_date_ir', $this->completion_date_ir])
            ->andFilterWhere(['like', 'country.country_name', $this->id_country]);

        return $dataProvider;
    }
}
