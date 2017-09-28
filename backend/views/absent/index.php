<?php
    use yii\helpers\Html;
    /* @var $this yii\web\View */
    /* @var $searchModel backend\models\TimelineSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */
    
    $this->title = 'Absent';
    $this->params['breadcrumbs'][] = $this->title;
    ?>    
<div class="row">
<?php
    $session = Yii::$app->session;
    if($session->has('Absent')){
    ?>
<div class="alert alert-success" role="alert">
    <?php
        ?>
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Success:</span>
    <?= $session->getFlash('Absent');?>
</div>
<?php } ?>
<div class="col-md-12 portlets">
    <div class="panel">
        <h3><i class="icon-calendar"></i> <strong>Schedule </strong> Sales Promotion Girls</h3>
        <div class="panel-content">
            <table class="table table-hover table-dynamic">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Name</th>
                        <th>Date Start</th>
                        <th>Date End</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $x = 0;
                        	foreach($model as $models):
                        	
                        	if($models->kontrak->status_kontrak == "S"){
                        		$message = "Schedule";
                        		$label	 = "success";
                        	}
                        	$x++;
                        ?>
                    <tr>
                        <td><?= $x ?></td>
                        <td><?= $models->kontrak->nama_event ?></td>
                        <td><?= $models->kontrak->perwakilan ?></td>
                        <td><?= $models->kontrak->tanggal_mulai ?></td>
                        <td><?= $models->kontrak->tanggal_akhir ?></td>
                        <td><span class="label label-<?= $label ?>"><?= $message?></span></td>
                        <td><?= Html::a('', ['detail-absent','id'=>$models->kontrak->idkontrak], ['class'=>'fa fa-pencil-square-o']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</row>