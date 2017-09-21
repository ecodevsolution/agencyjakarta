<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Privacy;

/**
 * PrivacySearch represents the model behind the search form about `backend\models\Privacy`.
 */
class PrivacySearch extends Privacy
{
    /**
     * @inheritdoc
     */
	public $Roles;
    public function rules()
    {
        return [
            [['idprivacy', 'role'], 'integer'],
            [['privacy','Roles'], 'safe'],
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
        $query = Privacy::find();
				$query->joinWith(['roles0']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			
        ]);

		
		$dataProvider->sort->attributes['Roles']=[ 
			'asc'=>['role.role_name' => SORT_ASC],
			'desc'=>['role.role_name'=> SORT_DESC],
		];
		
        

        if (!$this->load($params) && $this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idprivacy' => $this->idprivacy,
            'roles' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'privacy', $this->privacy])
			  ->andFilterWhere(['like', 'role_name', $this->Roles]);

        return $dataProvider;
    }
}
