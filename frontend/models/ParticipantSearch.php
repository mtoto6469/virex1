<?php

namespace frontend\models;

use common\models\User;
use frontend\models\Participant;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * ParticipantSearch represents the model behind the search form of `frontend\models\Participant`.
 */
class ParticipantSearch extends Participant
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_country', 'id_exhibitionn', 'id_room', 'id_company', 'teaser', 'buy', 'enable'], 'integer'],
            [['responsible_name', 'semat', 'email', 'fax', 'site_address', 'telegram', 'instagram', 'shortdescription', 'id_activity', 'dsescription', 'logoImg', 'filePdf', 'teaserGif'], 'safe'],
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
        $user=User::findOne(Yii::$app->user->getId());
        $profile=Profile::find()->where(['id_user'=>$user->id])->andWhere(['enable'=>1])->one();
//        $participant=Participant::find()->where(['enable'=>1])->andWhere(['id_company'=>$profile->id])->all();
//        foreach ($participant as $booth){
//            $id_participant=$booth->id;
//        }
        $query = Participant::find()->where(['enable'=>1])->andWhere(['id_company'=>$profile->id]);

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
            'id_images'=>$this->id_images,
            'buy' => $this->buy,
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
