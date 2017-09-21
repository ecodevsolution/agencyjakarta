<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Client';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form-index">
		<h1><?= Html::encode($this->title) ?></h1>
		<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

		<p>
			<?= Html::a('Create new Client', ['create'], ['class' => 'btn btn-success']) ?>
		</p>

		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],
				
				'username',
				'email',
				'company_name',
				'first_name',
				'Last_name',

			
				
						
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
