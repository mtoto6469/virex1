<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Room;

/**
 * RoomSearch represents the model behind the search form of `backend\models\Room`.
 */
class RoomSearch extends Room
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_country', 'id_exhibition', 'price', 'enable'], 'integer'],
            [['id_img', 'description'], 'safe'],
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
        $query = Room::find()->where(['enable'=>1]);

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
            'id_country' => $this->id_country,
            'id_exhibition' => $this->id_exhibition,
//            'id_activity' => $this->id_activity,
            'price' => $this->price,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'id_img', $this->id_img])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
