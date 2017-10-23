<?php

namespace backend\controllers;
use Yii;
use backend\models\Payment;
use backend\models\Timeline;
use backend\models\Kontrak;
use backend\models\TimelineApply;
use mPDF;


class PaymentController extends \yii\web\Controller
{
    public function actionIndex()
    {
		$model = Timeline::find()
				->joinWith('kontrak')
				->where(['status_pembayaran'=>'U'])
				->orderBy(['idkontrak'=>SORT_DESC])
				->all();
        return $this->render('index',[
			'model'=>$model,
		]);
    }
	
	public function actionIndexClient()
    {
		$model = Timeline::find()
				->joinWith('kontrak')
				->where(['idclient'=>Yii::$app->user->identity->id])
				->orderBy(['idkontrak'=>SORT_DESC])
				->all();
        return $this->render('index-client',[
			'model'=>$model,
		]);
    }
	public function actionInvoice()
    {
		$model = Timeline::find()
				->joinWith('kontrak')
				->where(['idclient'=>Yii::$app->user->identity->id])
				->orderBy(['idkontrak'=>SORT_DESC])
				->all();
        return $this->render('invoice',[
			'model'=>$model,
		]);
    }
	
	public function actionDetail($id)
    {
		$kode = $id;
		
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand("select * from kontrak k join user u on k.idclient = u.id 
										   join user_address a on u.id = a.iduser join 
										   user_contact uc on u.id = uc.iduser join
										   city c on a.idcity = c.idcity where k.idkontrak = '".$id."'");
		$model = $sql->queryOne();
		
		$query = $connection->createCommand("
											select u.first_name, u.Last_name, 
											datediff(k.tanggal_akhir, k.tanggal_mulai)+1 as duration , 
											100000 as fee, k.jml_spg, k.total_harga, (k.total_harga * (datediff(k.tanggal_akhir, 
											k.tanggal_mulai)+1)- 100000 ) as subtotal from user u join kontrak k 
											on u.id = k.idclient where k.idkontrak = '".$id."'		
										");
		$models = $query->queryAll();
        //var_dump($query);
		return $this->render('detail',[
			'kode'=>$kode,
			'model'=>$model,
			'models'=>$models,
		]);
    }
	public function actionReport(){
		return $this->render('report', [
				//'model'=>$model,
		]);
	}
	public function actionPrint($id){
		$mpdf=new mPDF();
        $mpdf->WriteHTML('
			<!DOCTYPE html>
				<html lang="en">
					<head>
						<style>
							.clearfix:after {
								content: "";
								display: table;
								clear: both;
							}
								
								a {
								color: #5D6975;
								text-decoration: underline;
							}
								
								body {
								position: relative;
								width: 21cm;  
								height: 29.7cm; 
								margin: 0 auto; 
								color: #001028;
								background: #FFFFFF; 
								font-family: Arial, sans-serif; 
								font-size: 12px; 
								font-family: Arial;
							}
								
								header {
								padding: 10px 0;
								margin-bottom: 30px;
							}
								
								#logo {
								text-align: center;
								margin-bottom: 10px;
							}
								
								#logo img {
								width: 90px;
							}
								
								h1 {
								border-top: 1px solid  #5D6975;
								border-bottom: 1px solid  #5D6975;
								color: #5D6975;
								font-size: 2.4em;
								line-height: 1.4em;
								font-weight: normal;
								text-align: center;
								margin: 0 0 20px 0;
								background: url(dimension.png);
							}
								
								#project {
								float: left;
							}
								
								#project span {
								color: #5D6975;
								text-align: right;
								width: 52px;
								margin-right: 10px;
								display: inline-block;
								font-size: 0.8em;
							}
								
								#company {
								float: right;
								text-align: right;
							}
								
								#project div,
								#company div {
								white-space: nowrap;        
							}
								
								table {
								width: 100%;
								border-collapse: collapse;
								border-spacing: 0;
								margin-bottom: 20px;
							}
								
								table tr:nth-child(2n-1) td {
								background: #F5F5F5;
							}
								
								table th,
								table td {
								text-align: center;
							}
								
								table th {
								padding: 5px 20px;
								color: #5D6975;
								border-bottom: 1px solid #C1CED9;
								white-space: nowrap;        
								font-weight: normal;
							}
								
								table .service,
								table .desc {
								text-align: left;
							}
								
								table td {
								padding: 20px;
								text-align: right;
							}
								
								table td.service,
								table td.desc {
								vertical-align: top;
							}
								
								table td.unit,
								table td.qty,
								table td.total {
								font-size: 1.2em;
							}
								
								table td.grand {
								border-top: 1px solid #5D6975;;
							}
								
								#notices .notice {
								color: #5D6975;
								font-size: 1.2em;
							}
								
								footer {
								color: #5D6975;
								width: 100%;
								height: 30px;
								position: absolute;
								bottom: 0;
								border-top: 1px solid #C1CED9;
								padding: 8px 0;
								text-align: center;
							}
						</style>
						<meta charset="utf-8">
						<title>Example 1</title>
					</head>
					<body>
						<header class="clearfix">
						<div id="logo">
							<img src="images/logo/Agency-Jakarta-Final1.png">
						</div>
						<h1>INVOICE_'.$id.'</h1>
						<div id="company" class="clearfix">
							<div>PT Bagus Pratama Mandiri <br />Jalan Gardenia Blok A4 No.4 Kemang Pratama Bekasi, 17114</div>
							<div>NPWP:</abbr> 02.727.563.5-432.000</div>
							<div><a href="mailto:cs@agencyjakarta.co.id">cs@agencyjakarta.co.id</a></div>
						</div>
						<div id="project">
							<div><span>PROJECT</span> Website development</div>
							<div><span>CLIENT</span> John Doe</div>
							<div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
							<div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
							<div><span>DATE</span> August 17, 2015</div>
							<div><span>DUE DATE</span> September 17, 2015</div>
						</div>
						</header>
						<main>
						<table>
							<thead>
							<tr>
								<th class="service">SERVICE</th>
								<th class="desc">DESCRIPTION</th>
								<th>PRICE</th>
								<th>QTY</th>
								<th>TOTAL</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td class="service">Design</td>
								<td class="desc">Creating a recognizable design solution based on the companys existing visual identity</td>
								<td class="unit">$40.00</td>
								<td class="qty">26</td>
								<td class="total">$1,040.00</td>
							</tr>
							<tr>
								<td class="service">Development</td>
								<td class="desc">Developing a Content Management System-based Website</td>
								<td class="unit">$40.00</td>
								<td class="qty">80</td>
								<td class="total">$3,200.00</td>
							</tr>
							<tr>
								<td class="service">SEO</td>
								<td class="desc">Optimize the site for search engines (SEO)</td>
								<td class="unit">$40.00</td>
								<td class="qty">20</td>
								<td class="total">$800.00</td>
							</tr>
							<tr>
								<td class="service">Training</td>
								<td class="desc">Initial training sessions for staff responsible for uploading web content</td>
								<td class="unit">$40.00</td>
								<td class="qty">4</td>
								<td class="total">$160.00</td>
							</tr>
							<tr>
								<td colspan="4">SUBTOTAL</td>
								<td class="total">$5,200.00</td>
							</tr>
							<tr>
								<td colspan="4">TAX 25%</td>
								<td class="total">$1,300.00</td>
							</tr>
							<tr>
								<td colspan="4" class="grand total">GRAND TOTAL</td>
								<td class="grand total">$6,500.00</td>
							</tr>
							</tbody>
						</table>
						<div id="notices">
							<div>NOTICE:</div>
							<div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
						</div>
						</main>
						<footer>
						Invoice was created on a computer and is valid without the signature and seal.
						</footer>
					</body>
				</html>
		');
        $mpdf->Output();
        exit;

	}
	public function actionActive($id, $c){
		$apply = TimelineApply::find()
				->where(['idtimeline'=> $id])
				->All();
		foreach($apply as $applys):
			$applys->status = 2;
			$applys->save();
		endforeach;
		
		return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'?r=payment/detail-payment&id='.$c);
	}
	public function actionDetailPayment($id)
    {
		$kode = $id;
		
		$model = Payment::find()
				->where(['idkontrak'=>$id])
				->all();
		$kontrak = Kontrak::find()
			->where(['idkontrak'=>$id])
			->One();
			
		$timeline = Timeline::find()
				->joinWith(['timelineApply'])
				->joinWith(['kontrak'])
				->where(['kontrak.idkontrak'=> $id])
				->One();
				
		return $this->render('detail-payment',[
			'kode'=>$kode,
			'model'=>$model,
			'timeline' => $timeline,
			'kontrak'=> $kontrak,
		]);
    }
	public function actionCreate()
    {
		$model = new Payment();
		
		
		if ($model->load(Yii::$app->request->post())){
		$kontrak = Kontrak::find()
				->where(['idkontrak'=>$model->idkontrak])
				->One();
		$pay = Payment::find()
			->where(['idkontrak'=>$model->idkontrak])
			->count();
		var_dump($pay);
		$payment = Payment::find()
			->where(['idkontrak'=>$model->idkontrak])
			->orderBy(['idpayment'=>SORT_DESC])
			->one();
		if($pay == 0){
			$nominal = $kontrak->total_harga * $kontrak->jml_spg;
			$left = $nominal - $model->nominal;
		}else{
			$nominal = $payment->left;
			$left = $nominal - $model->nominal;
		}
		
		$model->left = $left;
		$model->save();
		$model = Timeline::find()
				->joinWith('kontrak')
				->where(['idclient'=>Yii::$app->user->identity->id])
				->orderBy(['idkontrak'=>SORT_DESC])
				->all();	
		return $this->render('index-client',[
			'model'=>$model,
		]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	
	protected function findModel($id)
    {
        if (($model = Payment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
