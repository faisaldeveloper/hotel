<?php

$this->breadcrumbs=array(

	'Hotel Titles'=>array('index'),

	'Manage',

);



$this->menu=array(

	//array('label'=>'List HotelTitle', 'url'=>array('index')),

	array('label'=>'Create HotelTitle', 'url'=>array('create')),

);



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('hotel-title-grid', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<h1><?php echo Yii::t('views','Manage Hotel Titles') ?> </h1>



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



<?php 



$this->widget('zii.widgets.grid.CGridView', array(

	'id'=>'hotel-title-grid',

	'dataProvider'=>$model->search(),

	'filter'=>$model,

	'columns'=>array(

		'id',

		'title',

		'application_title',

		'website',

		//'logo_image',

		  array(

		 'name'=>'logo_image',

		 'type'=>'html',

		 'value'=>'(!empty($data->logo_image))?CHtml::image(\"/hotel/hotel_logos/".$data->logo_image,"",array("style"=>"width:35px;height:35px;")):"no image"',

		 

		 //'value'=>'"----".$data->logo_image',  

		 

		 

		  /*  'class' => 'PcLinkButton',

		  //'imageUrlExpression' => 'SomeModel::getWebPath($some_param) . basename($data->icon_filename)',

		  'imageUrlExpression' =>  "CHtml::image('/hotel/hotel_logos/121016074754Hydrangeas.jpg', 'logo', array('width'=>50, 'height'=>50))",			//'\"/hotel/hotel_logos/hotel-logo.png"',

		  //'urlExpression' => '\"/hotel/hotel_logos/121016074754Hydrangeas.jpg"',

		  'labelExpression' => '$data->logo_image',

		  'header' => 'Logo',  */

    	 ),

		//'bg_image',

		array(

			'class'=>'CButtonColumn',

		),

	),

)); ?>

 <img 