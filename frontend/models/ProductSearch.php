<?php
//
namespace frontend\models;
//
//use Yii;
//use yii\base\Model;
//use yii\data\ActiveDataProvider;
//use frontend\models\Product;
//
///**
// * ProductSearch represents the model behind the search form of `frontend\models\Product`.
// */
//class ProductSearch extends Product
//{
//    /**
//     * {@inheritdoc}
//     */
//    public function rules()
//    {
//        return [
//            [['id', 'id_participant',  'id_category', 'enable'], 'integer'],
//            [['id_img','title', 'typePro', 'shortDescription', 'description'], 'safe'],
//        ];
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function scenarios()
//    {
//        // bypass scenarios() implementation in the parent class
//        return Model::scenarios();
//    }
//
//    /**
//     * Creates data provider instance with search query applied
//     *
//     * @param array $params
//     *
//     * @return ActiveDataProvider
//     */
//    public function search($params)
//    {
//        $user = User::findOne(Yii::$app->user->getId());
//        $profile=Profile::find()->where(['enable'=>1])->andWhere(['id_user'=>$user->id])->one();
//        $participant = Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $profile->id])->one();
//        $booth = $participant->id;
//
//        $query = Product::find()->where(['enable'=>1])->andWhere(['id_participant'=>$booth]);
//
//        // add conditions that should always apply here
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }
////        else{var_dump($this->getErrors());exit;}
//
//        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'id_participant' => $this->id_participant,
//            'id_img' => $this->id_img,
//            'id_category' => $this->id_category,
//            'enable' => $this->enable,
//        ]);
//
//        $query->andFilterWhere(['like', 'title', $this->title])
////            ->andFilterWhere(['like', 'id_img', $this->id_img])
//            ->andFilterWhere(['like', 'typePro', $this->typePro])
//            ->andFilterWhere(['like', 'shortDescription', $this->shortDescription])
//            ->andFilterWhere(['like', 'description', $this->description]);
//
//        return $dataProvider;
//    }
//}




use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form of `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_participant', 'id_img', 'id_Category', 'enable'], 'integer'],
            [['title', 'typePro', 'shortDescription', 'description'], 'safe'],
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
        $profile=Profile::find()->where(['enable'=>1])->andWhere(['id_user'=>$user->id])->one();
        $participant = Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $profile->id])->one();
        $booth = $participant->id;

        $query = Product::find()->where(['enable'=>1])->andWhere(['id_participant'=>$booth]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//
//        $query = Product::find();

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
            'id_img' => $this->id_img,
            'id_Category' => $this->id_Category,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'typePro', $this->typePro])
            ->andFilterWhere(['like', 'shortDescription', $this->shortDescription])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
