<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Factor;

/**
 * FactorSearch represents the model behind the search form of `backend\models\Factor`.
 */
class FactorSearch extends Factor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_exhibition', 'id_room', 'id_company', 'id_user', 'price', 'visible', 'print', 'enable'], 'integer'],
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
    public function search($params,$visible,$print)
    {
        $query = Factor::find()->filterWhere(['!=','ref',0]);
        if ($visible==0 && $print==0){
            $query=$query->where(['visible'=>0])->andWhere(['print'=>0]);
        }
        if ($visible==1&& $print==0){
            $query=$query->where(['visible'=>1])->andWhere(['print'=>0]);
        }
        if ($visible==0 && $print==1){
            $query=$query->where(['visible'=>0])->andWhere(['print'=>1]);
    }
        if ($visible==1 && $print==1){
            $query=$query->where(['visible'=>1])->andWhere(['print'=>1]);
        }

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
            'price' => $this->price,
            'date' => $this->date,
            'time' => $this->time,
            'visible' => $this->visible,
            'print' => $this->print,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'date_ir', $this->date_ir])
            ->andFilterWhere(['like', 'time_ir', $this->time_ir])
            ->andFilterWhere(['like', 'atu', $this->atu])
            ->andFilterWhere(['like', 'ref', $this->ref]);

        return $dataProvider;
    }
}
