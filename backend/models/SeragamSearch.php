<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Seragam;

/**
 * SeragamSearch represents the model behind the search form about `backend\models\Seragam`.
 */
class SeragamSearch extends Seragam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idseragam', 'harga'], 'integer'],
            [['deskripsi_seragam'], 'safe'],
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
        $query = Seragam::find();

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
            'idseragam' => $this->idseragam,
            'harga' => $this->harga,
        ]);

        $query->andFilterWhere(['like', 'deskripsi_seragam', $this->deskripsi_seragam]);

        return $dataProvider;
    }
}
