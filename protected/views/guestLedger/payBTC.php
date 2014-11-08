

<h1><?php echo Yii::t('views','Company BTC Overdue Payments') ?></h1>



<?php 

 $this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'guest-ledger-grid',

	'dataProvider'=>$model->btc(),

	//'selectableRows'=>2,

	'filter'=>$model,

	'columns'=>array(

		//'id',

		array('header'=>'Sr:','class'=>'IndexColumn'),

		//array('id'=>'selectedItems','class'=>'CCheckBoxColumn'),

		//'c_date',

		'company_id',		

		'balance',

				

		array(

    	'class'=>'update-dialog-create',

    	'template'=>'{view}',

    	'buttons'=>array(

			'view'=>array(			

			'url'=>'Yii::app()->controller->createUrl("payBTC",array("id"=>$data->company_id))',			

			),			

		)),		

		))); 

        

        ?>

		

  