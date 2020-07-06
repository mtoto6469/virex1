<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Activity;

/**
 * ActivitySearch represents the model behind the search form of `backend\models\Activity`.
 */
class ActivitySearch extends Activity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'enable', 'id_exhibition', 'id_country'], 'integer'],
            [['activity'], 'safe'],
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

        //زمانی که به این شکل مینویسم خطای Call to a member function andFilterWhere() on array
//        $query = Activity::find()->where(['enable'=>1])->all();
        $query = Activity::find()->where(['enable'=>1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
//        $query->joinWith('idcountry')->where([Activity::tableName() . '.enable' => 1]);
//        $query->joinWith('idexhibition')->where([Activity::tableName() . '.enable' => 1]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_country' => $this->id_country,
            'id_exhibition' => $this->id_exhibition,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'activity', $this->activity]);
//            ->andFilterWhere(['like', 'country.country_name', $this->id_country]);
//            ->andFilterWhere(['like', 'exhibition.title', $this->id_exhibition]);

        return $dataProvider;
    }
}
