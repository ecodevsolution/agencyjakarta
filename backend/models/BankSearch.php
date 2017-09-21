<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Bank;

/**
 * BankSearch represents the model behind the search form about `backend\models\Bank`.
 */
class BankSearch extends Bank
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idbank'], 'integer'],
            [['bank_name'], 'safe'],
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
        $query = Bank::find();

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
            'idbank' => $this->idbank,
        ]);

        $query->andFilterWhere(['like', 'bank_name', $this->bank_name]);

        return $dataProvider;
    }
}
