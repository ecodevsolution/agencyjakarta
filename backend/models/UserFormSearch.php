<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserForm;

/**
 * UserFormSearch represents the model behind the search form about `backend\models\UserForm`.
 */
class UserFormSearch extends UserForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idrole', 'idcity', 'high', 'weight', 'status', 'created_at', 'updated_at'], 'integer'],
            [['idposition', 'username', 'first_name', 'Last_name', 'language', 'face', 'kelengkapan', 'company_name', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = UserForm::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'idrole' => $this->idrole,
            'idcity' => $this->idcity,
            'high' => $this->high,
            'weight' => $this->weight,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'idposition', $this->idposition])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
			->andFilterWhere(['like', 'idrole', $this->idrole = 1])
            ->andFilterWhere(['like', 'Last_name', $this->Last_name])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'face', $this->face])
            ->andFilterWhere(['like', 'kelengkapan', $this->kelengkapan])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
