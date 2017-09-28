<?php
    use yii\helpers\Html;
    /* @var $this yii\web\View */
    /* @var $searchModel backend\models\TimelineSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */
    
    $this->title = 'Shift';
    $this->params['breadcrumbs'][] = ['label' => 'Absent', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
    ?>    
<div class="row">
    <div class="col-md-12 portlets">
        <div class="panel">
            <h3><i class="icon-calendar"></i> <strong>Schedule </strong> Sales Promotion Girls</h3>
            <div class="panel-content">
                <table class="table table-hover table-dynamic">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Shift</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $x = 0;
                            	foreach($model as $models):
                            	$x++;
                            ?>
                        <tr>
                            <td><?= $x ?></td>
                            <td>Shift <?= $models['idshift'] ?></td>
                            <td><?= Html::a('', ['spg-absent','id'=>$models['idjadwal'],'shift'=>$models['idshift']], ['class'=>'fa fa-pencil-square-o']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>