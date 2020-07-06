<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Sessionfrontenduser;

/**
 * SessionfrontenduserSearch represents the model behind the search form of `frontend\models\Sessionfrontenduser`.
 */
class SessionfrontenduserSearch extends Sessionfrontenduser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ip', 'data'], 'safe'],
            [['id_user', 'expire'], 'integer'],
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
        $query = Sessionfrontenduser::find();

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
            'id_user' => $this->id_user,
            'expire' => $this->expire,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
