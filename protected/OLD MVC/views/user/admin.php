<?php

$this->breadcrumbs=array(

	'Users'=>array('index'),

	'Manage',

);



$this->menu=array(

	//array('label'=>'List User', 'url'=>array('index')),

	array('label'=>'Create User', 'url'=>array('create')),

);



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('user-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<h1><?php echo Yii::t('views','Manage Users') ?> </h1>



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

	'id'=>'user-grid',

	'dataProvider'=>$model->search(),

	'filter'=>$model,

	'columns'=>array(

		//'id',

		array('header'=>'Sr #','class'=>'IndexColumn'),

		'username',

		'password',

		'email',

		//'hotel_id',

		array('name'=>'hotel_id', 'value'=>'$data->hotel->title'),

		//'hotel_branch_id',

		array('name'=>'hotel_branch_id', 'value'=>'$data->hotelBranch->branch_address'),

		array(

			'class'=>'CButtonColumn',

		),

	),

)); ?>

