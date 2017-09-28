<?php
    use yii\helpers\Html;
    use yii\web\View;
    use yii\widgets\ActiveForm;
    use backend\models\Kontrak;
    use backend\models\Timeline;
    use yii\helpers\ArrayHelper;
    use wbraganca\dynamicform\DynamicFormWidget;
    use yii\db\Query; 
    use backend\models\jadwal;
    use backend\models\TimelineApply;
    use backend\models\ShiftJadwal;
    use backend\models\DetailJadwal;
    /* @var $this yii\web\View */
    /* @var $model backend\models\Jadwal */
    /* @var $form yii\widgets\ActiveForm */
    
     
    $this->title = 'Schedule Manager';
    $this->params['breadcrumbs'][] = ['label' => 'Schedule', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
    
    
    $root = '@web';
    
    //  $this->registerJsFile($root."/js/jquery-1.7.1.min.js",
    // ['position' => View::POS_HEAD]);
    
    $this->registerJsFile($root."/js/fullcalendar/moment.min.js",
    ['position' => View::POS_HEAD]);

    $this->registerJsFile($root."/js/fullcalendar/jquery.min.js",
    ['position' => View::POS_HEAD]);

    $this->registerJsFile($root."/js/fullcalendar/fullcalendar.min.js",
    ['position' => View::POS_HEAD]);

   

    $this->registerJsFile($root."/js/fullcalendar/bootstrap.min.js",
    ['position' => View::POS_HEAD]);

 
    ?>
<script>
    $( function() {
         $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
       } );
       
        $( function() {
         $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
       } );
       
      
       $( function() {
          $( "#timeshift1" ).timepicker().val();
       } );
       $( function() {
          $( "#timeshift2" ).timepicker().val();
       } );
     
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-3 col-xlg-2 p-0">
                <div class="widget">
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h2 class="text-white semi-bold" id="calender-current-day">Schedule Manager</h2>
                                <div id="external-events">
                                    <br>

                                    <?php
                                        foreach($event as $events):

                                        $kontrak = Kontrak::find()
                                                ->where(['idkontrak'=>$events->timeline->idkontrak])
                                                ->One();
                                    ?>                                    
                                    <div class="external-event bg-<?= $events->color; ?>" data-class="bg-<?= $events->color; ?>" style="position: relative;">
                                        <i class="fa fa-move"></i><?= $kontrak->nama_event ?> <p style="font-size:10px"><?=  date('d M Y',strtotime($kontrak->tanggal_mulai)) .' - '. date('d M Y',strtotime($kontrak->tanggal_akhir)) ?></p>
                                    </div>

                                    <?php endforeach; ?>
                                  
                                </div>
                                <a href="#" data-toggle="modal" data-target="#add-category" class="add-category"><i class="icon-plus"></i> Create new Event</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button"  style="float:right" class="btn btn-primary" data-toggle="modal" data-target="#add-shift"><i class="fa fa-plus"></i> Create Shift</button>
            <button type="button"  style="float:right" class="btn btn-success" data-toggle="modal" data-target="#add-schedule"><i class="fa fa-plus"></i> Create Jadwal</button>
           
            <div class="col-md-9 col-xlg-10 p-0 no-bd">
                <div class="widget">
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



           <?php $form = ActiveForm::begin(); ?>
            <!-- Modal -->
           <div class="modal fade" id="add-category">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Add</strong> Events</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Event Name</label>
                                        <?= $form->field($model, 'idtimeline')->dropDownList(
                                                ArrayHelper::map(Timeline::find()->JoinWith('kontrak')->where(['<>','status_kontrak','E'])->all(),'idtimeline', 'kontrak.nama_event'),
                                                ['prompt'=>'- Choose -'])->label(false);				 
                                        ?>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Choose Event Color</label>
                                        <select class="form-control form-white" data-placeholder="Choose a color..." name="color">
                                            <option value="green">Green</option>
                                            <option value="red">Red</option>
                                            <option value="blue">Blue</option>
                                            <option value="yellow">Yellow</option>
                                            <option value="dark">Dark</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                            <?= Html::submitButton('Save', ['class' => 'btn btn-danger btn-embossed save-category']) ?>                                                        
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>


            <?php $form = ActiveForm::begin(); ?>
            <!-- Modal Shift -->
           <div class="modal fade" id="add-shift">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Add</strong> Shift</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label">Shift Description</label>
                                        <?= $form->field($shift, "keterangan")->textInput()->label(false)?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Time In</label>
                                          <?= $form->field($shift, "jam_masuk")->textInput(['id'=>'timeshift1'])->label(false)?>
                                    </div>
                                     <div class="col-md-6">
                                        <label class="control-label">Time Out</label>
                                          <?= $form->field($shift, "jam_keluar")->textInput(['id'=>'timeshift2'])->label(false)?>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                            <?= Html::submitButton('Save', ['class' => 'btn btn-danger btn-embossed save-category']) ?>                                                        
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
                <!--END MODAL SHIFT-->

             <?php $form = ActiveForm::begin(); ?>
                <!--MODAL SCHEDULE-->
            <div class="modal fade" id="add-schedule">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Add</strong> SPG Schedule</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <label class="control-label">Event</label>
                                        <?= $form->field($details, 'idjadwal')->dropDownList(
                                                ArrayHelper::map(Timeline::find()->JoinWith('kontrak')->where(['status_kontrak'=>'S'])->all(),'idtimeline', 'kontrak.nama_event'),
                                                ['prompt'=>'- Choose -'])->label(false);				 
                                        ?>                                        
                                    </div>
                                   
                                    <div class="col-md-6 col-xs-12">                                       
                                        <div id="view_spg"></div>                                                                               
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                 
                                    <?php
                                        $model_shift = ShiftJadwal::find()
                                        ->all();
                                        $data = array();

                                      ?>
                                        <label class="control-label">Choose Shift</label>
                                    <?php
                                          foreach ($model_shift as $modelx)
                                                $data[$modelx->idshift] = $modelx->keterangan . ' ('. $modelx->jam_masuk .' - '. $modelx->jam_keluar.')';     
                                                 echo $form->field($details, 'idshift')->dropDownList($data ,array('prompt' => '--Choose--'))->label(false);	 
                                    ?>                                       
                                               
                                    </div>
                                    <div class="col-md-6  col-xs-12">
                                        <label class="control-label">Date</label>
                                          <?= $form->field($details, "tanggal")->textInput(['id'=>'datepicker1'])->label(false)?>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                            <?= Html::submitButton('Save', ['class' => 'btn btn-danger btn-embossed save-category']) ?>                                                        
                        </div>
                    </div>
                </div>
            </div>
                <!--/END MODAL SCHEDULE-->
               <?php ActiveForm::end(); ?>
            


            <!--FULL CALENDAR MODAL-->
            <div id="calendarModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                            <h4 id="modalTitle" class="modal-title"></h4>
                        </div>
                        <div id="modalBody" class="modal-body"> </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--END FULL CALENDAR MODAL-->


        </div>
    </div>
</div>


<script> 
    ( function($) {

        
        $(document).ready(function() {
        
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            
            $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
                eventClick:  function(event, jsEvent, view) {
                $('#modalTitle').html(event.title);
                $('#modalBody').html(event.description);                
                $('#eventUrl').attr('href',event.url);
                $('#calendarModal').modal();
            },
       

            eventRender: function(event, eventElement) {
                     <?php
                        	$connection = \Yii::$app->db;
			                $sql = $connection->createCommand("SELECT * FROM jadwal a JOIN  timeline b ON a.idtimeline = b.idtimeline JOIN kontrak c ON b.idkontrak = c.idkontrak");
			                $list_color = $sql->queryAll();

                        foreach($list_color as $list_colors):
                    ?>             
                        if (event.title == '<?= $list_colors['nama_event'] ?>') {
                            eventElement.addClass('bg-<?= $list_colors['color'] ?>');
                        }
                    <?php
                        endforeach;
                    ?>
                },
            editable: true,
            events: [ 
                <?php
                    $list = DetailJadwal::find()
                            ->joinWith('userForm')
                            ->joinWith('jadwal')
                            ->joinWith('shiftJadwal')
                            ->where(['flag_status'=>1])
                            ->All();
                    foreach($list as $lists):
                    
                    $t_l = Timeline::findOne($lists->jadwal->idtimeline);
                    $title = Kontrak::findOne($t_l->idkontrak);
                ?>             
                {
                    id: <?= $lists->jadwal->idjadwal ?>,
                    title: '<?= $title->nama_event ?>',                
                    start:  '<?= $lists->tanggal ?>T<?= $lists->shiftJadwal->jam_masuk ?>',
                    end:  '<?= $lists->tanggal ?>T<?= $lists->shiftJadwal->jam_keluar ?>', 
                    description: '<?= ucfirst($lists->userForm->first_name) ?> <?= ucfirst($lists->userForm->Last_name) ?><br/><?= date("d M Y",strtotime($lists->tanggal)) ?> - <?= date("d M Y",strtotime($lists->tanggal)) ?><br/><?= $lists->shiftJadwal->jam_masuk ?> - <?= $lists->shiftJadwal->jam_keluar ?>',
                    url: '#',
                    allDay: false
                },
                <?php
                    endforeach;
                ?>
                
            ],
            

            timeFormat: 'H(:mm)'
            });
            
        });
      }) ( jQuery );
</script>




<?php 
	$this->registerJs("
		( function($) {
			
			function loading(){
				$('#loading').html('<img src=images/loader.gif />').fadeIn('fast');
			}
			function loading_out(){
				$('#loading').fadeOut('fast');
			}
			$(document).ready(function()
			{
				$('#detailjadwal-idjadwal').change(function()					
				{
					var id=$(this).val();						
					var dataString = 'id='+ id;
					loading();
					$.ajax
					({
						type: 'GET',
						url: '?r=jadwal/detail-spg',
						data: dataString,
						cache: false,
						success: function(html)
						{
							loading_out();
							$('#view_spg').html(html);								
						} 
					});
				});
			});
		}) ( jQuery );
	");
?>