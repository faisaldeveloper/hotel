<h1> <?php echo Yii::t('views','Folio #') ?><?php echo $chkin_id; ?></h1>
<?php 
$dr_total = GuestLedger::model()->getDrTotal($chkin_id);
$cr_total = GuestLedger::model()->getCrTotal($chkin_id);
$amount_due = $dr_total - $cr_total;

global $ggtotal;
$ggtotal =0 ;
Yii::import('zii.widgets.grid.CGridColumn'); 

class TotalColumn extends CGridColumn { 
    private $_total = 0; 
    public function renderDataCellContent($row, $data) { // $row number is ignored 
        $this->_total += $data->debit; 
		 $this->_total -= $data->credit;
		 $ggtotal = $this->_total;
        echo $this->_total;
    }
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'guest-ledger-grid',
	'dataProvider'=>GuestLedger::model()->search_view($chkin_id),
	'selectableRows'=>2,
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		array('header'=>'Sr:','class'=>'IndexColumn'),
		//array('id'=>'selectedItems','class'=>'CCheckBoxColumn'),
		//'service_id',
		array('name'=>'service_id', 'value'=>'$data->service->service_description'),
		'remarks',
		'c_date',
		array(
			'name'=>'debit',		
			'value'=>'$data->debit',
			'type'=>'text',
			'footer'=>'<b>'.$dr_total.'</b>',  //$provider->itemCount===0 ? '' : $model->getTotals(),
		),		
		array(
			'name'=>'credit',
			'value'=>'$data->credit',
			'type'=>'text',
    		'footer'=>'<b>'.$cr_total.'</b>',
    		//'class'=>'ext.TotalColumn',
		)	
  ) ));   
?>

<div><h2 id="gtotal"><?php echo "Balance: Rs. ". $amount_due; ?> </h2></div>
<script>
$(document).ready(function(){
var a = $("#guest-ledger-grid tr:last td:last").text();
//$("#gtotal").text('Total Bill : '+a);
 //$("#guest-ledger-grid tr th:last").remove();
 //$("#guest-ledger-grid tr td:last").remove();
});
</script>
<?php 
///// 
/*
array(
    'header'=>'Total Due',
    'class'=>'ext.TotalColumn',
    'value'=>'(floatval($data->price_ex_vat)+floatval($data->delivery_price_ex_vat)) * '.(1+$this->vat_rate),
    //'name'=>'value',
    'output'=>'Yii::app()->getNumberFormatter()->formatCurrency($value,"GBP")',
    'type'=>'raw',
    'footer'=>true
),
*/

/////////////
/* $this->widget('application.components.widgets.XDetailView', array(
 'data'=>$model,
 'ItemColumns' => 2,
 'attributes'=>array(
 		//'id',
		//'guest_name',
		array('name'=>'guest_name', 'label'=>'Guest Name','value'=>$model->guest_name),
		'chkin_id',	
		'room_status',
		'room_id',
		'chkin_date',
		'chkout_date',
		'c_date',
		'c_time',
		'service_id',
		'remarks',
		'debit',
		'credit',
		'balance',
		'cash_paid',
		'credit_card',
		'credit_card_no',
		'btc',
		'company_id',
		//'user_id',
		'late_out',
		//'branch_id',
 ),

));  */

?>



