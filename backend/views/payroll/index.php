
<?php
	
	use yii\web\View;
	use yii\widgets\ActiveForm;
	


	$this->title = 'Payroll';
	$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile("https://code.jquery.com/jquery-1.12.4.js",
			['position' => View::POS_HEAD]);
			
$this->registerJsFile("https://code.jquery.com/ui/1.12.1/jquery-ui.js",
			['position' => View::POS_HEAD]);


?>


<script>
  $( function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  } );
  
   $( function() {
    $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  } );
  </script>
<div class="row">
	<div class="col-lg-6 portlets">
		<div class="panel">
			<div class="panel-header panel-controls">
				<h3><i class="icon-calendar"></i> <strong>Add Payroll</strong></h3>
			</div>
			<?php $form = ActiveForm::begin(); ?>
			<div class="panel-content">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-label">Range Selection</label>
							<div class="input-daterange b-datepicker input-group" id="datepicker">
								<input type="text" class="input-sm form-control" placeholder="Beginning..." name="start" id="datepicker1">								
								<span class="input-group-addon">to</span>							
								<input type="text" class="input-sm form-control" id="datepicker2" name="end" placeholder="Ending..."/>
							</div>
						</div> 
					
						<div class="form-group">
							<label class="form-label">Status</label>					
							<select class="form-control form-white" data-style="white" data-placeholder="Select Status...">
								<option value="1">Paid</option>
								<option value="0">Not Paid</option>								
							</select>							
							
							
							
						</div> 
						
						<div class="form-group">
							
							<button type="submit" class="btn btn-success btn-transparent pull-right">Search</button>
						</div>
					</div>                                        
				</div>
			</div>
									
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>