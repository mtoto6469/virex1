<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Img;

/**
 * ImgSearch represents the model behind the search form of `frontend\models\Img`.
 */
class ImgSearch extends Img
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_participant', 'enable'], 'integer'],
            [['fileImg','filePdf','fileMove', 'address', 'alt', 'uses'], 'safe'],
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
        $user = User::findOne(Yii::$app->user->getId());
        $participant = Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $user->id])->one();
        $booth = $participant->id;
        
        $query = Img::find()->where(['enable'=>1])->andWhere(['id_participant'=>$booth]);

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
            'id_participant' => $this->id_participant,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'fileImg', $this->fileImg])
            ->andFilterWhere(['like', 'filePdf', $this->filePdf])
            ->andFilterWhere(['like', 'fileMove', $this->fileMove])
            ->andFilterWhere(['like', 'alt', $this->alt])
            ->andFilterWhere(['like', 'uses', $this->uses]);

        return $dataProvider;
    }
}
