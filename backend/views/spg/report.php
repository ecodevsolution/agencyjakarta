<?php
	
	use yii\web\View;
	use yii\widgets\ActiveForm;	
	use yii\widgets\LinkPager;
	



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
			<div class="panel-header panel-controls ">
				<h3><i class="icon-calendar"></i> <strong>Report SPG</strong></h3>				
			</div>
			<?php $form = ActiveForm::begin(); ?>
			<div class="panel-content">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-label">Range Selection</label>
							<div class="input-daterange b-datepicker input-group" id="datepicker">
								<input type="text" class="input-sm form-control" placeholder="Beginning..." required="true"  name="start" id="datepicker1">								
								<span class="input-group-addon">to</span>							
								<input type="text" class="input-sm form-control" id="datepicker2" name="end" required="true"  placeholder="Ending..."/>
							</div>
						</div> 
					
						<div class="form-group">
							<label class="form-label">Status</label>					
							<select class="form-control form-white" name="status" data-style="white" data-placeholder="Select Status...">
								<option value="Y">Active</option>
								<option value="P">Pending</option>
								<option value="N">Reject</option>							
							</select>							
							
							
							
						</div> 
						
						<div class="form-group">
							
							<input type="submit" value="Search" class="btn btn-success btn-transparent pull-right"></input>
						</div>
					</div>                                        
				</div>
			</div>
									
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>


<?php
	if(isset($_POST['status'])){
?>		
	
    <div class="panel">
        <div class="panel-header panel-controls" style="display: block;">
            <h3><i class="fa fa-table"></i> <strong>Sales Promotion Girls </strong> options <small>export to Excel</small></h3>
           
        </div>
        <div class="panel-content">
            <div class="filter-left">
                <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline no-footer">
                    <div class="row" style="display: block;">
                        <div class="col-md-6">
                          
                        </div>
                        <div class="col-md-6">
                            <div class="DTTT_container btn-group" style="display: block;">
								<script type="text/javascript">
									var tableToExcel = (function() {
									var uri = 'data:application/vnd.ms-excel;base64,'
										, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
										, base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
										, format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
									return function(table, name) {
										if (!table.nodeType) table = document.getElementById(table)
										var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
										window.location.href = uri + base64(format(template, ctx))
									}
									})()
								</script>
								<button type="button" onclick="tableToExcel('testTable', 'Report SPG')" class="btn btn-default">
									<span class="fa fa-file-excel-o"></span> 
								</button>								                                                               
                            </div>
                        </div>
                    </div>
					
                    <table class="table table-dynamic table-tools dataTable no-footer" id="testTable" role="grid" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="ascending" style="width: 229px;">First Name</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 191px;">Last Name</th>
                                <th class="hidden-350 sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 171px;">High</th>
                                <th class="hidden-1024 sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 202px;">City</th>
                                <th class="hidden-480 sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 143px;">Email</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
								foreach($model as $models):
							?>
                            <tr role="row" class="odd">
                                <td class="sorting_1"><?= $models->first_name ?></td>
                                <td><?= $models->Last_name ?></td>
                                <td class="hidden-350"><?= $models->high ?></td>
                                <td class="hidden-1024"><?= $models->city->city_name ?></td>
                                <td class="hidden-480"><?= $models->email ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="row" style="display: block;">
                        <div class="col-md-6">
                            <div class="dataTables_info" id="DataTables_Table_1_info" role="status" aria-live="polite">Showing 1 to 50 entries</div>
                        </div>
                        <div class="spcol-md-6an6">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_1_paginate" style="display: block;">
                                <?= LinkPager::widget(['pagination' => $pages,]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


	
<?php } ?>