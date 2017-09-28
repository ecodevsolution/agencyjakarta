<?php
    use yii\helpers\Html;
    use backend\models\DetailJadwal;
    /* @var $this yii\web\View */
    /* @var $searchModel backend\models\TimelineSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */
    
    $this->title = 'Detail Payroll';
    $this->params['breadcrumbs'][] = ['label' => 'Payroll', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
    ?>    
<div class="row">
<?php
    $session = Yii::$app->session;
    if ($session->isActive) {
    ?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Success:</span>
    <?= $session->getFlash('periode');?>
</div>
<?php } ?>
<div class="col-md-12 portlets">
    <div class="panel">
        <h3><i class="icon-calendar"></i> <strong>Payroll </strong> Sales Promotion Girls</h3>
        <div class="panel-content">
            <table class="table table-hover table-dynamic">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Date Start</th>
                        <th>Date End</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $x = 0;
                        	foreach($models as $model):
                        	$x++;
                        ?>
                    <tr>
                        <td><?= $x ?></td>
                        <td><?= $model['nama_event']?></td>
                        <td><?= $model['tanggal_mulai']?></td>
                        <td><?= $model['tanggal_akhir']?></td>
                        <?php
                            $cari = DetailJadwal::find()
                            		->where(['idjadwal'=>$model['idjadwal']])
                            		->andWhere(['flag'=>1])
                            		->count();
                            if($cari > 0){
                            	
                            ?>
                        <td><?= Html::a('', ['periode','id'=>$model['idjadwal']], ['class'=>'fa fa-pencil-square-o']) ?></td>
                        <?php }else {echo"<td><p><span class='text text-danger'>Payroll was Paid</span></p></td>";} ?>
                    </tr>
                    <?php  endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
