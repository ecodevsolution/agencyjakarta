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
            [['idkontrak', 'idclient', 'perwakilan', 'email', 'telp', 'tanggal_mulai', 'tanggal_akhir', 'jam_mulai', 'jam_akhir', 'lokasi', 'alamat', 'status_rekomendasi', 'status_kontrak', 'status_pembayaran', 'tanggal'], 'safe'],
            [['durasi_kontrak', 'jumlah_pramuniaga', 'pramuniaga_rekomendasi', 'budget'], 'integer'],
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
            'jumlah_pramuniaga' => $this->jumlah_pramuniaga,
            'pramuniaga_rekomendasi' => $this->pramuniaga_rekomendasi,
            'budget' => $this->budget,
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
