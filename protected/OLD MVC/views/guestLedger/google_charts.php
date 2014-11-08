

<h2><?php echo Yii::t('views','Occcupancy Chart') ?></h2>

<?php



$sql = "select cmp.comp_name, count(ci.guest_id) AS total_guest 

FROM hms_checkin_info ci

LEFT JOIN hms_company_info cmp

ON ci.guest_company_id = comp_id

WHERE chkout_status = 'N'

GROUP BY ci.guest_company_id";



$data = array(); $g_total =0;

$res = Yii::app()->db->createCommand($sql)->query();

foreach($res as $row){

	$key = $row['total_guest']."-".$row['comp_name'];

	$data[$key] = $row['total_guest'];	

	$g_total += $row['total_guest'];	

}

//print_r($data);

//pie chart

$this->widget('ext.widgets.google.XGoogleChart',array(

    'type'=>'pie',

    'title'=>'View Occupancy By Company - Total ('.$g_total.')',

    //'data'=>array('IE7'=>22,'IE6'=>30.7,'IE5'=>1.7,'Firefox'=>36.5,'Mozilla'=>1.1,'Safari'=>2,'Opera'=>1.4),

	'data'=>$data,

    'size'=>array(700,400), // width and height of the chart image

    'color'=>array('6f8a09', '3285ce','dddddd'), // if there are fewer color than slices, then colors are interpolated.

));



/* $this->widget('ext.widgets.google.XGoogleChart',array(

    'type'=>'line',

    'title'=>'Browser market 2008',

    'data'=> array(

        '2007'=>array('Jan'=>61.0,'Feb'=>51.2,'Mar'=>61.8,'Apr'=>42.9,'May'=>33.7,'June'=>34.0,'July'=>34.5,'August'=>34.9,'Sept'=>45.4,'Oct'=>46.0,'Nov'=>46.3,'Dec'=>46.3),

        '2006'=>array('Jan'=>35.0,'Feb'=>34.5,'Mar'=>44.5,'Apr'=>32.9,'May'=>22.9,'June'=>25.5,'July'=>25.5,'August'=>24.9,'Sept'=>37.3,'Oct'=>37.3,'Nov'=>39.9,'Dec'=>39.9),

        '2005'=>array('Jan'=>15.0,'Feb'=>14.5,'Mar'=>24.5,'Apr'=>22.9,'May'=>12.9,'June'=>15.5,'July'=>15.5,'August'=>14.9,'Sept'=>17.3,'Oct'=>27.3,'Nov'=>29.9,'Dec'=>29.9)

    ),

    'size'=>array(550,200),

    'color'=>array('c93404','6f8a09','3285ce'),

    'fill'=>array('f8d4c8','d4e1a5'),

    'gridSize'=>array(9,20), // x-axis and y-axis step of the grid

    'gridStyle'=>'light', // optional: light or solid

    'axes'=>array('x','y'),

)); */



 ?>

