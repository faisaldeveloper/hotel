<?php

$this->breadcrumbs=array(

	'Guest Ledgers'=>array('index'),

	'Company Payments',

);



$this->menu=array(

	//array('label'=>'List GuestLedger', 'url'=>array('index')),

	//array('label'=>'Create GuestLedger', 'url'=>array('create')),

	//array('label'=>'Update GuestLedger', 'url'=>array('update', 'id'=>$model->id)),

	//array('label'=>'Delete GuestLedger', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),

	//array('label'=>'Manage GuestLedger', 'url'=>array('admin')),

);

?>



<h1><?php echo Yii::t('views','Company Overdue Payments') ?></h1>





<?php 

$this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'guest-ledger-grid',

	'dataProvider'=>$model->btc(),

	'selectableRows'=>2,

	'filter'=>$model,

	'columns'=>array(

		//'id',

		array('header'=>'Sr:','class'=>'IndexColumn'),

		//array('id'=>'selectedItems','class'=>'CCheckBoxColumn'),

		//'c_date',

		//'company_id',

		array('name'=>'company_id', 'value'=>'$data->company->comp_name'),

		

		'balance',

		//array('name'=>'service_id', 'value'=>'$data->service->service_description'),

		//array('name'=>'debit',

		//'debit',

		//'credit',

		

		/*array(

			'class'=>'CButtonColumn',

		),*/

		array(

    	'class'=>'CButtonColumn',

    	'template'=>'{view}',

    	'buttons'=>array(

			'view'=>array(

			'url'=>'Yii::app()->controller->createUrl("payBTC",array("id"=>$data->company_id))',

			),

		)),

		

		)));

        

        ?>