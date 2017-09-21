<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use backend\models\Kontrak;
    use yii\helpers\ArrayHelper;
    use dosamigos\tinymce\TinyMce;
    use yii\web\View;
    use wbraganca\dynamicform\DynamicFormWidget;
    use backend\models\UserCategory;
    /* @var $this yii\web\View */
    /* @var $model backend\models\Timeline */
    /* @var $form yii\widgets\ActiveForm */
    ?>
<?php $form = ActiveForm::begin([
    'options' => ['enctype'=>'multipart/form-data',
    'role'=>'form',									
    'id' => 'dynamic-form']
    ]); 
    // $root = '@web';
    // $this->registerJsFile($root."/plugins/jquery/jquery-1.11.1.min.js",
    // ['depends' => [\yii\web\JqueryAsset::className()],
    // 'position' => View::POS_END]);
    
    $this->registerJsFile("https://code.jquery.com/jquery-1.12.4.js",
			['position' => View::POS_HEAD]);
			
	$this->registerJsFile("https://code.jquery.com/ui/1.12.1/jquery-ui.js",
			['position' => View::POS_HEAD]);

    ?>
	
<script>
  $( function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  } );
  
  </script>
  
<div class="user-form-form">
    <div class="col-lg-12">
        <div class="tab-content">
            <div class="tab-pane active" id="style">
                <div class="wizard-div current wizard-circle">
                    <fieldset>
                        <div class="panel-heading">
                            <h4><i class="glyphicon glyphicon-user"></i> Contract Information </h4>
                        </div>
                        <div class="row">
                            <label>Contract</label>
                            <?= $form->field($model, 'idkontrak')->dropDownList(
                                ArrayHelper::map(Kontrak::find()->where(['status_kontrak'=>'P'])->all(),'idkontrak','idkontrak'),
                                ['prompt'=>'- Choose -']
                                )->label(false)
                            ?>
							
							<div id="loading"></div>
							<div id="view_kontrak"></div>
							
							
                            <label>Image Timeline</label>
                            <?= $form->field($model, 'img_event')->fileInput()->label(false) ?>
                            <label>Date Briefing</label>
							<input type="text" class="form-control" placeholder="Date Briefing..." name="start" id="datepicker1">								
                            
                        </div>
                      
                    </fieldset>
                    <fieldset>
                        <legend>Detail Grade </legend>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="glyphicon glyphicon-envelope"></i> Grade SPG </h4>
                            </div>
                            <div class="panel-body">
                                <?php DynamicFormWidget::begin([
                                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                    'widgetBody' => '.container-items', // required: css class selector
                                    'widgetItem' => '.item', // required: css class
                                    'limit' => 100, // the maximum times, an element can be cloned (default 999)
                                    'min' => 1, // 0 or 1 (default 1)
                                    'insertButton' => '.tambah-item', // css class
                                    'deleteButton' => '.hapus-item', // css class
                                    'model' => $detail[0],
                                    'formId' => 'dynamic-form',
                                    'formFields' => [
                                    	'idcategory',
                                    	'jumlah',
                                    	'diskon',
                                    	'harga',
                                    ],
                                    ]);
                                    
                                    ?>
                                <div class="container-items">
                                    <!-- widgetContainer -->
                                    <?php foreach ($detail as $i => $details): ?>										
                                    <div class="item panel panel-default">
                                        <!-- widgetBody -->
                                        <div class="panel-heading">
                                            <h3 class="panel-title pull-left">Add Grade</h3>
                                            <div class="pull-right">
                                                <button type="button" class="tambah-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                                <button type="button" class="hapus-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">																							
                                                <label>SPG</label>
                                                <?= $form->field($details, "[{$i}]idkategori")->dropDownList(
                                                    ArrayHelper::map(UserCategory::find()																	
                                                    	->all(), 'idcategory', 'grade'), ['prompt'=>'- Choose -']
														)->label(false)
																										
                                                ?>															
                                                <?= $form->field($details, "[{$i}]harga")->textInput()->label('Price') ?>
                                            </div>
                                        </div>
                                        <!-- .row -->
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="form-group">											
                                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                </div>
                            </div>
                            <?php DynamicFormWidget::end(); ?>
                        </div>
                    </fieldset>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


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
					$('#timeline-idkontrak').change(function()					
					{
						var id=$(this).val();						
						var dataString = 'id='+ id;
						loading();
						$.ajax
						({
							type: 'GET',
							url: '?r=timeline/detail-kontrak',
							data: dataString,
							cache: false,
							success: function(html)
							{
								loading_out();
								$('#view_kontrak').html(html);								
							} 
						});
					});
				});
			}) ( jQuery );
		");
?>
