<?php
	
	use yii\web\View;
	
	$root = '@web';
	$this->registerCssFile($root.'/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
	 ['position' => View::POS_END]);
	
	
	$this->registerJsFile($root."/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js",
		['depends' => [\yii\web\JqueryAsset::className()],
		'position' => View::POS_END]);
?>	