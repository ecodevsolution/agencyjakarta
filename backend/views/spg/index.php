<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data SPG';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form-index">
		<h1><?= Html::encode($this->title) ?></h1>
		<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--		<p>
			<?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
		</p> --!>

		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],
					[
					'attribute' => 'username',
					'format' => 'raw',
					'value' => function ($model) {
						return Html::a($model->username, ['detail-spg', 'id' => $model->id]);
					
					},
				],			
				'email',
				'first_name',
				'Last_name',
				[
					'attribute'=>'categoryname',
					'value'=>'category0.grade',
				],
				[
					'attribute' => 'kelengkapan',
					'format' => 'raw',
					'value' => function ($model) {
						if($model->kelengkapan == 'P'){
							return Html::a('', ['proses', 'id' => $model->id, 'status'=>'Y'],['class'=>'fa fa-check-circle-o fa-2x']);
						}else if($model->kelengkapan == 'Y'){
							return Html::a('', ['proses', 'id' => $model->id, 'status'=>'N'],['class'=>'fa fa-times fa-2x']);
						}else if($model->kelengkapan == 'N'){
							return Html::a('', ['index'],['class'=>'fa fa-trash fa-2x']);
						}
						
						
					},
				],			
						
				// 'first_name',
				// 'Last_name',
				// 'high',
				// 'weight',
				// 'language',
				// 'face',
				// 'kelengkapan',
				// 'company_name',
				// 'auth_key',
				// 'password_hash',
				// 'password_reset_token',
				// 'email:email',
				// 'status',
				// 'created_at',
				// 'updated_at',

				['class' => 'yii\grid\ActionColumn'],
			],
		]); ?>
</div>
