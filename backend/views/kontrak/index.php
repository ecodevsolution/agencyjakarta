<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KontrakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kontrak';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kontrak-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kontrak', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           [
				'attribute' =>  'idkontrak',
				'format' => 'raw',
				'value' => function ($model) {
					// return Html::a($model->idkontrak, ['#']);
					 
					return  '<a href="#" data-toggle="modal" data-id='.$model->idkontrak.' class="open-AddBookDialog" data-target="#myModal">'.$model->idkontrak.'</a>';
				
				},
			],	
            [
				'attribute'=>'client',
				'value'=>'userForm.username',
			],
            'perwakilan',
            'email:email',
            'telp',
            // 'tanggal_mulai',
            // 'tanggal_akhir',
            // 'jam_mulai',
            // 'jam_akhir',
            // 'durasi_kontrak',
            // 'lokasi',
            // 'alamat:ntext',
            // 'jumlah_pramuniaga',
            // 'status_rekomendasi',
            // 'pramuniaga_rekomendasi',
            // 'budget',
            // 'status_kontrak',
            // 'status_pembayaran',
            // 'tanggal',

            ['class' => 'yii\grid\ActionColumnCustom'],
        ],
    ]); ?>

		<div class="container">            
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Detail Kontrak</h4>
                        </div>
                        <div class="modal-body">        
							<div class="form-group">
								<label>ID Kontrak</label>
								<input type="text" name="bookId" class="form-control"  readonly="true" id="idkontrak" value=""/>
							</div>
							<div id="view">
							
							</div>
							
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
		$this->registerJs('
			$(document).on("click", ".open-AddBookDialog", function () {
				var idkontrak = $(this).data("id");
				$(".modal-body #idkontrak").val( idkontrak );
								
				var dataString = "id="+ idkontrak;
				$.ajax
				({

					type: "GET",
					url: "?r=kontrak/detail",
					data: dataString,
					cache: false,
					success: function(html)

					{					
						$("#view").html(html);
					} 

				});
			});
		'); ?>
</div>
