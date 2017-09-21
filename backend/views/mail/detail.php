<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use backend\models\Sendmail;
$this->title = 'Mail Event';
$this->params['breadcrumbs'][] = $this->title;

$root = '@web';
$this->registerJsFile($root."/js/jquery-1.9.1.js",
			['depends' => [\yii\web\JqueryAsset::className()],
			'position' => View::POS_HEAD]);
?>  
	
	
<?php $form = ActiveForm::begin(); ?>
	<div class="row">
        <div class="col-md-12 portlets">
          <div class="panel">
		 <h3><i class="icon-bulb"></i> <strong>Event  </strong> Lists </h3>
		 
            <div class="panel-content">
              <table class="table table-hover table-dynamic">
                <thead>
                  <tr>
			<th>#</th>
                    <th>Nama</th>
					<th>Status</th>
					<th><input type="checkbox" onchange="checkAll(this)" name="chk[]" /> Check All</th>
                  </tr>
                </thead>
				<script>
					$(document).ready(function () {
						$("input[type=checkbox]").click(function (e) {
							if ($(e.currentTarget).closest("tbody").length > 0) {
								disableInputs($(e.currentTarget).closest("tbody")[0]);        
							}
						});
					});
					
					function disableInputs(questionElement) {
						console.log(questionElement);
						if ($(questionElement).data('max-answers') == undefined) {
							return true;
						} else {
							maxAnswers = parseInt($(questionElement).data('max-answers'), 10); 
							if ($(questionElement).find(":checked").length >= maxAnswers) {
								$(questionElement).find(":not(:checked)").attr("disabled", true);
							} else {
								$(questionElement).find("input[type=checkbox]").attr("disabled", false);
							}
						}
					}
				</script>
                <tbody data-max-answers="10">
					<?php
						foreach($model as $j => $models):
						$count = Sendmail::find()
								->where(['idspg'=>$models->id])
								->Andwhere(['idtimline'=>$kode])
								->count();
						if($count >= 1){
							$label = "<label class='text-success'>Email Sent</label>";
						}else{
							$label =  "<label class='text-danger'>Not Send</label>";
						}
					?>
						<tr colspan="2">
							<td><input type="checkbox" name="check[<?= $j ?>]" value="<?= $models->id?>"/></td>
							<td><?= $models->first_name .' '.$models->Last_name ?></td>
							<td><?= $label; ?></td>
						</tr>
						
						
					<?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
	</div>
	<div class="col-md-12">
		<div class="form-group text-right">
			<input type="hidden" name="id" value="<?= $kode ?>">
			<?= Html::submitButton('Send', ['class' =>'btn btn-primary']) ?>
		</div>
	</div>
	<script>
		function checkAll(ele) {
			var checkboxes = document.getElementsByTagName('input');
			if (ele.checked) {
				for (var i = 0; i < checkboxes.length; i++) {
					if (checkboxes[i].type == 'checkbox') {
						checkboxes[i].checked = true;
					}
				}
			} else {
				for (var i = 0; i < checkboxes.length; i++) {
					console.log(i)
					if (checkboxes[i].type == 'checkbox') {
						checkboxes[i].checked = false;
					}
				}
			}
		}
	</script>
<?php ActiveForm::end(); ?>