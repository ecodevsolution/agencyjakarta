<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DownPayment;

/**
 * DownPaymentSearch represents the model behind the search form about `backend\models\DownPayment`.
 */
class DownPaymentSearch extends DownPayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iddownpayment', 'idkontrak', 'nominal'], 'integer'],
            [['keterangan'], 'safe'],
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
        $query = DownPayment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'iddownpayment' => $this->iddownpayment,
            'idkontrak' => $this->idkontrak,
            'nominal' => $this->nominal,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
