<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserForm;

/**
 * UserFormSearch represents the model behind the search form about `backend\models\UserForm`.
 */
class SpgSearch extends UserForm
{
    /**
     * @inheritdoc
     */
	
	public $categoryname;
	
    public function rules()
    {
        return [
            [['id', 'idrole', 'idcity', 'high', 'weight', 'idcategory' ,'status' ,'created_at', 'updated_at'], 'integer'],
            [['categoryname', 'idposition', 'username', 'first_name', 'Last_name', 'join_date', 'language', 'face', 'kelengkapan', 'company_name', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
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
		$query->joinWith(['category0']);
		$query->Where(['idrole'=> 2]);
		//$query->AndWhere(['<>','user_category.idcategory', '']);
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,			
        ]);
		
		//category
		$dataProvider->sort->attributes['categoryname']=[ 
			'asc'=>['user_category.grade' => SORT_ASC],
			'desc'=>['user_category.grade'=> SORT_DESC],
		];		    
		
		if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'idrole' => $this->idrole,
            'idcity' => $this->idcity,
			'categoryname' => $this->idcategory,			
            'high' => $this->high,
            'weight' => $this->weight,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'idposition', $this->idposition])
            ->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'idrole', $this->idrole])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
			->andFilterWhere(['like', 'user_category.grade', $this->categoryname])
            ->andFilterWhere(['like', 'Last_name', $this->Last_name])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'face', $this->face])
            ->andFilterWhere(['like', 'kelengkapan', $this->kelengkapan ])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
