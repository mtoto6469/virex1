<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property int $id_participant
 * @property string $typePro
 * @property string $id_img
 * @property int $id_category
 * @property string $shortDescription
 * @property string $description
 * @property int $enable
 */
class Product extends \yii\db\ActiveRecord
{
    public $fileMove1;
    public $fileMove2;
    public $fileMove3;
    public $fileMove4;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['id_participant', 'id_category', 'enable'], 'integer'],
            [['description'], 'string'],
            [['title', 'typePro'], 'string', 'max' => 250],
            [['id_img', 'shortDescription'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'نام محصول',
            'id_participant' => 'کد غرفه دار',
            'typePro' => 'نوع محصول',
            'id_img' => 'نام عکس',
            'id_category' => 'نام دسته',
            'shortDescription' => 'توضیحات کوتاه',
            'description' => 'توضیحات',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
?>
////////////////////////////////SEARCH//////////////////////////////////////////
<?php
//
//namespace backend\models;
//
//use Yii;
//use yii\base\Model;
//use yii\data\ActiveDataProvider;
//use backend\models\Product;
//
///**
// * ProductSearch represents the model behind the search form of `backend\models\Product`.
// */
//class ProductSearch extends Product
//{
//    /**
//     * {@inheritdoc}
//     */
//    public function rules()
//    {
//        return [
//            [['id', 'id_participant', 'id_category', 'enable'], 'integer'],
//            [['title', 'typePro', 'id_img', 'shortDescription', 'description'], 'safe'],
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
//        $profile1 = Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
//        $participant = Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $profile1->id])->one();
//        $booth = $participant->id;
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
//
//        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'id_participant' => $this->id_participant,
//            'id_category' => $this->id_category,
//            'enable' => $this->enable,
//        ]);
//
//        $query->andFilterWhere(['like', 'title', $this->title])
//            ->andFilterWhere(['like', 'typePro', $this->typePro])
//            ->andFilterWhere(['like', 'id_img', $this->id_img])
//            ->andFilterWhere(['like', 'shortDescription', $this->shortDescription])
//            ->andFilterWhere(['like', 'description', $this->description]);
//
//        return $dataProvider;
//    }
//}
