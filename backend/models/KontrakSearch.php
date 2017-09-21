<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Kontrak;

/**
 * KontrakSearch represents the model behind the search form about `backend\models\Kontrak`.
 */
class KontrakSearch extends Kontrak
{
    /**
     * @inheritdoc
     */
	public $client; 
	
    public function rules()
    {
        return [
            [['idkontrak', 'perwakilan', 'nama_event', 'email', 'telp', 'tanggal_mulai', 'tanggal_akhir', 'jam_mulai', 'jam_akhir', 'lokasi', 'alamat', 'description_spg', 'status_kontrak', 'status_pembayaran', 'tanggal'], 'safe'],
            [['idclient', 'idseragam', 'idtl', 'durasi_kontrak', 'jml_spg'], 'integer'],
            [['total_harga'], 'number'],
			[['client'], 'safe'],
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
        $query = Kontrak::find();
		$query->joinWith(['userForm']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['client']=[ 
			'asc'=>['user.username' => SORT_ASC],
			'desc'=>['user.username'=> SORT_DESC],
		];		

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'client' => $this->idclient,
            'idseragam' => $this->idseragam,
            'idtl' => $this->idtl,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_akhir' => $this->tanggal_akhir,
            'durasi_kontrak' => $this->durasi_kontrak,
            'jml_spg' => $this->jml_spg,
            'total_harga' => $this->total_harga,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'idkontrak', $this->idkontrak])
            ->andFilterWhere(['like', 'perwakilan', $this->perwakilan])
            ->andFilterWhere(['like', 'nama_event', $this->nama_event])
			->andFilterWhere(['like', 'user.username', $this->client])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'jam_mulai', $this->jam_mulai])
            ->andFilterWhere(['like', 'jam_akhir', $this->jam_akhir])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'description_spg', $this->description_spg])
            ->andFilterWhere(['like', 'status_kontrak', $this->status_kontrak])
            ->andFilterWhere(['like', 'status_pembayaran', $this->status_pembayaran]);

        return $dataProvider;
    }
}
