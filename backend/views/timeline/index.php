<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Kontrak;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Timelines';
$this->params['breadcrumbs'][] = $this->title;


			
?>
<div class="timeline-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Timeline', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

				
            //'description:ntext',
			[
				'attribute' =>  'Event Name',
				'format' => 'raw',
				'value' => function ($model) {
					$models = Kontrak::find()
							->where(['idkontrak'=>$model->idkontrak])
							->One();
					return  '<a href="#" data-toggle="modal" data-id='.$model->idkontrak.' class="open-AddBookDialog" data-target="#myModal">'.$models->nama_event.'</a>';				
				},
			],
			[
				'attribute' =>  'date_event',
				'format' => 'raw',
				'value' => function ($model) {
					// return Html::a($model->idkontrak, ['#']);
					 
					return  date('d M Y', strtotime($model->date_event));
				
				},
			],            
					
            'author',
            // 'date_created',

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
					url: "?r=timeline/detail",
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



