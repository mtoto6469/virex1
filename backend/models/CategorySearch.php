<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Category;

/**
 * CategorySearch represents the model behind the search form of `backend\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_parent', 'id_participant','id_img', 'enable'], 'integer'],
            [['title',  'description'], 'safe'],
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
        $profile1 = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
        $participant = Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $profile1->id])->one();
        $booth = $participant->id;
        $query = Category::find()->where(['enable'=>1])->andWhere(['id_participant'=>$booth]);

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
            'id_parent' => $this->id_parent,
            'id_participant' => $this->id_participant,
            'id_img'=>$this->id_img,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
//            ->andFilterWhere(['like', 'id_img', $this->id_img])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
