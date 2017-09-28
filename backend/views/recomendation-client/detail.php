<?php
    use yii\helpers\Html;
    use backend\models\UserForm;
    use backend\models\TimelineApply;
    use backend\models\City;
    use backend\models\Kontrak;
    use backend\models\Timeline;
    /* @var $this yii\web\View */
    /* @var $searchModel backend\models\TimelineSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */
    
    $this->title = 'Recomendation detail';
    $this->params['breadcrumbs'][] = ['label' => 'Recomendation', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
    ?>
<div class="timeline-index">
    <div class="row">
        <div class="col-lg-12 portlets">
            <div class="panel">
                <div class="panel-header panel-controls">
                    <h3><i class="fa fa-table"></i> <strong>List Recomendation </strong> Event <?= $event->kontrak->nama_event; ?></h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                    <table class="table table-hover table-dynamic">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>City</th>
                                <th>High</th>
                                <th>Face</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $mod = Kontrak::find()
                                	->where(['idkontrak'=>$event->idkontrak])
                                	->One();
                                $count = TimelineApply::find()
                                	->where(['status'=>6])
                                	->AndWhere(['idtimeline'=>$event->idtimeline])
																	->count();
																
                                $count = $mod->jml_spg - $count;
                                
                                foreach($model as $models):
                                ?>
                            <tr>
                                <td><?= Html::a(ucwords($models['first_name']), ['//spg/detail-spg','id' => $models['id']],['target'=>'_Blank']);  ?></td>
                                <td><?= $models['city_name'] ?></td>
                                <td><?= $models['high']?></td>
                                <td><?= $models['face']?></td>
																<?php
																		$this->registerCss("
																			.f{
																				color:red;
																			}
																			.w{
																				color:orange;
																				font-size:14px;
																			}
																		");
																	// if($models['status'] == 1){
																	// 	echo"<td><span class='fa fa-exclamation-triangle fa-2x w'></span></td>";
																	// }else{																		
																		if($models['status'] == 4){
																				if($count == 0){
																					echo"<td><span class='fa fa-times-circle fa f'> Auto Rejected</span></td>";
																				}else{
																		?>
																		<td><?= Html::a('', ['//recomendation-client/approve', 'id' => $models['idtimeline'], 'status'=>6, 's'=>$models['id'], 'val'=>1],['class'=>'fa fa-check-circle-o']); ?> | 
																		<?= Html::a('', ['//recomendation-client/approve', 'id' => $models['idtimeline'], 'status'=>7,'s'=>$models['id'], 'val'=>1],['class'=>'fa fa-times-circle f']); ?></td>
																		<?php
																				}
																		}
																			else if($models['status'] == 6){
																				echo"<td><span class='fa fa-check-circle-o fa-2x'></span> |
																						<a class='fa fa-reply' href='?r=recomendation-client%2Fapprove&amp;id=".$models['idtimeline']."&amp;status=4&amp;s=".$models['id']."&amp;val=0' title='undo process'></a></td>";
																				
																			}else if($models['status'] == 7 || $models['status'] == 3){
																				echo"<td><span class='fa fa-times-circle fa-2x f'></span> | 
																				<a class='fa fa-reply' href='?r=recomendation-client%2Fapprove&amp;id=".$models['idtimeline']."&amp;status=4&amp;s=".$models['id']."&amp;val=0' title='undo process'></a></td>";
																			}else{
																				echo"<td><span class='fa fa-exclamation-triangle fa-2x w'> Waiting Approval</span></td>";
																			}
																			
																	//}
																	?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php					
                        echo "<p style='color:red'>max recomendation sales promotion girls   ".$mod->jml_spg . "  Left   ". $count."</p>";
                        //echo $kontrak->idkontrak;					
                         ?>
                </div>
            </div>
        </div>
    </div>
</div>