<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `backend\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'state', 'rules', 'enable', 'first'], 'integer'],
            [['role', 'name', 'username', 'id_img', 'email', 'password', 'telephone', 'mobile', 'company_name_en', 'company_name_ir', 'date', 'date_ir', 'date_update', 'date_update_ir', 'code'], 'safe'],
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
        $query = Profile::find()->where(['enable' => 1]);

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
            'id_user' => $this->id_user,
            'date' => $this->date,
            'date_update' => $this->date_update,
            'state' => $this->state,
            'id_img' => $this->id_img,
            'rules' => $this->rules,
            'first' => $this->first,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'company_name_en', $this->company_name_en])
            ->andFilterWhere(['like', 'company_name_ir', $this->company_name_ir])
            ->andFilterWhere(['like', 'date_ir', $this->date_ir])
            ->andFilterWhere(['like', 'date_update_ir', $this->date_update_ir])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
