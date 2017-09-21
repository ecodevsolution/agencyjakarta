<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserExperience;

/**
 * UserExperienceSearch represents the model behind the search form about `backend\models\UserExperience`.
 */
class UserExperienceSearch extends UserExperience
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idexperience', 'iduser'], 'integer'],
            [['deskripsi', 'tahun'], 'safe'],
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
        $query = UserExperience::find();

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
            'idexperience' => $this->idexperience,
            'iduser' => $this->iduser,
        ]);

        $query->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
			->andFilterWhere(['like', 'iduser', $this->iduser = Yii::$app->user->identity->id])
            ->andFilterWhere(['like', 'tahun', $this->tahun]);

        return $dataProvider;
    }
}
