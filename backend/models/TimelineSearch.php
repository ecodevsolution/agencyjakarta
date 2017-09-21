<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Timeline;

/**
 * TimelineSearch represents the model behind the search form about `backend\models\Timeline`.
 */
class TimelineSearch extends Timeline
{
    /**
     * @inheritdoc
     */
	
    public function rules()
    {
        return [
            [['idtimeline'], 'integer'],
            [['idkontrak', 'img_event', 'date_event', 'author', 'date_created'], 'safe'],
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
        $query = Timeline::find();

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
            'idtimeline' => $this->idtimeline,
            'date_event' => $this->date_event,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'idkontrak', $this->idkontrak])
            ->andFilterWhere(['like', 'img_event', $this->img_event])
            ->andFilterWhere(['like', 'author', $this->author]);

        return $dataProvider;
    }
}
