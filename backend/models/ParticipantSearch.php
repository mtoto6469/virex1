<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Participant;

/**
 * ParticipantSearch represents the model behind the search form of `backend\models\Participant`.
 */
class ParticipantSearch extends Participant
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_country', 'id_exhibitionn', 'id_room', 'id_company', 'teaser', 'buy','id_images' ,'enable'], 'integer'],
            [['responsible_name', 'semat', 'email', 'fax', 'site_address', 'telegram', 'instagram', 'shortdescription','id_activity', 'dsescription'], 'safe'],
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
        $query = Participant::find()->where(['enable'=>1]);

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
            'id_exhibitionn' => $this->id_exhibitionn,
            'id_room' => $this->id_room,
            'id_company' => $this->id_company,
//            'id_activity' => $this->id_activity,
            'teaser' => $this->teaser,
            'buy' => $this->buy,
            'id_images'=>$this->id_images,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'responsible_name', $this->responsible_name])
            ->andFilterWhere(['like', 'semat', $this->semat])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'id_activity', $this->id_activity])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'site_address', $this->site_address])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'shortdescription', $this->shortdescription])
            ->andFilterWhere(['like', 'dsescription', $this->dsescription]);


        return $dataProvider;
    }
}
