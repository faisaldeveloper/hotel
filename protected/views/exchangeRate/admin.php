<?php

$this->breadcrumbs=array(

	'Exchange Rates'=>array('index'),

	'Manage',

);



$this->menu=array(

	//array('label'=>'List ExchangeRate', 'url'=>array('index')),

	array('label'=>'Create ExchangeRate', 'url'=>array('create')),

);



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('exchange-rate-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<h1> <?php echo Yii::t('views','Manage Exchange Rates') ?></h1>



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

	'id'=>'exchange-rate-grid',

	'dataProvider'=>$model->search(),

	'filter'=>$model,

	'columns'=>array(

		//'excange_rate_id',

		array('header'=>'Sr #','class'=>'IndexColumn'),

		//'country_id',

		array('name'=>'country_id', 'value'=>'$data->country->country_name'),

		'sign',

		'exchabge_rate',

		//'branch_id',

		//'user_id',

		array(

			'class'=>'CButtonColumn',

		),

	),

)); ?>

