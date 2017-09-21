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
    
     
    $this->title = 'Schedule';
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
            
    
            <div class="col-md-12 col-xlg-10 p-0 no-bd">
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
                            ->AndWhere(['iduser'=> Yii::$app->user->identity->id])
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