<?php

$this->breadcrumbs=array(

	'HMS Branches'=>array('index'),

	'Manage',

);



$this->menu=array(

	//array('label'=>'List Branches', 'url'=>array('index')),

	array('label'=>'Create Branches', 'url'=>array('create')),

);



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('hms-branches-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<h1><?php echo Yii::t('views','Manage Branches') ?></h1>



<!--<p>

You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>

or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.

</p>-->



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">

<?php $this->renderPartial('_search',array(

	'model'=>$model,

)); ?>

</div><!-- search-form -->



<?php $this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'hms-branches-grid',

	'dataProvider'=>$model->search(),

	'filter'=>$model,

	'columns'=>array(

		//'branch_id',

		array('header'=>'Sr #','class'=>'IndexColumn'),

		'branch_address',

		'branch_phone',

		'branch_fax',

		'branch_email',

		//'hotel_id',

		array('name'=>'hotel_id', 'value'=>'$data->hotel->title'),

		/*

		'active_date',

		'expiry_date',

		*/

		array(

			'class'=>'CButtonColumn',

		),

	),

)); ?>

