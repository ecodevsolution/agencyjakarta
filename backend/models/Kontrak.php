<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kontrak".
 *
 * @property string $idkontrak
 * @property integer $idclient
 * @property integer $idseragam
 * @property integer $idtl
 * @property string $perwakilan
 * @property string $nama_event
 * @property string $email
 * @property string $telp
 * @property string $tanggal_mulai
 * @property string $tanggal_akhir
 * @property string $jam_mulai
 * @property string $jam_akhir
 * @property integer $durasi_kontrak
 * @property string $lokasi
 * @property string $alamat
 * @property integer $jml_spg
 * @property string $description_spg
 * @property double $total_harga
 * @property string $status_kontrak
 * @property string $status_pembayaran
 * @property string $tanggal
 */
class Kontrak extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kontrak';
    }

    /**
     * @inheritdoc
     */
	 
	public function getUserForm()
    {
        return $this->hasOne(UserForm::className(), ['id' => 'idclient']);
    }
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
    public function attributeLabels()
    {
        return [
            'idkontrak' => 'Idkontrak',
            'idclient' => 'Idclient',
            'idseragam' => 'Idseragam',
            'idtl' => 'Idtl',
            'perwakilan' => 'Perwakilan',
            'nama_event' => 'Nama Event',
            'email' => 'Email',
            'telp' => 'Telp',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_akhir' => 'Tanggal Akhir',
            'jam_mulai' => 'Jam Mulai',
            'jam_akhir' => 'Jam Akhir',
            'durasi_kontrak' => 'Durasi Kontrak',
            'lokasi' => 'Lokasi',
            'alamat' => 'Alamat',
            'jml_spg' => 'Jml Spg',
            'description_spg' => 'Description Spg',
            'total_harga' => 'Total Harga',
            'status_kontrak' => 'Status Kontrak',
            'status_pembayaran' => 'Status Pembayaran',
            'tanggal' => 'Tanggal',
        ];
    }
}
