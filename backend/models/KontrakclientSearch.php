<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Kontrak;

/**
 * KontrakSearch represents the model behind the search form about `backend\models\Kontrak`.
 */
class KontrakclientSearch extends Kontrak
{
    /**
     * @inheritdoc
     */
     public function rules()
     {
         return [
             [['idkontrak', 'idclient', 'perwakilan', 'nama_event', 'email', 'telp', 'tanggal_mulai', 'tanggal_akhir', 'jam_mulai', 'jam_akhir', 'durasi_kontrak', 'lokasi', 'alamat', 'jml_spg', 'description_spg', 'total_harga', 'status_kontrak', 'status_pembayaran', 'tanggal'], 'required'],
             [['idclient', 'idseragam', 'idtl', 'durasi_kontrak', 'jml_spg'], 'integer'],
             [['tanggal_mulai', 'tanggal_akhir', 'tanggal'], 'safe'],
             [['alamat', 'description_spg', 'status_kontrak', 'status_pembayaran'], 'string'],
             [['total_harga'], 'number'],
             [['idkontrak'], 'string', 'max' => 10],
             [['perwakilan', 'nama_event', 'email'], 'string', 'max' => 50],
             [['telp'], 'string', 'max' => 14],
             [['jam_mulai', 'jam_akhir'], 'string', 'max' => 20],
             [['lokasi'], 'string', 'max' => 255],
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
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_akhir' => $this->tanggal_akhir,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'durasi_kontrak' => $this->durasi_kontrak,
            'jml_spg' => $this->jml_spg,
            'pramuniaga_rekomendasi' => $this->pramuniaga_rekomendasi,
            'total_harga' => $this->total_harga,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'idkontrak', $this->idkontrak])
            ->andFilterWhere(['like', 'idclient', $this->idclient = Yii::$app->user->identity->id])
            ->andFilterWhere(['like', 'perwakilan', $this->perwakilan])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'status_rekomendasi', $this->status_rekomendasi])
            ->andFilterWhere(['like', 'status_kontrak', $this->status_kontrak])
            ->andFilterWhere(['like', 'status_pembayaran', $this->status_pembayaran]);

        return $dataProvider;
    }
}
