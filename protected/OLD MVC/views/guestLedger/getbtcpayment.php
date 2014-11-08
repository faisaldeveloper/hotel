<?php

$this->breadcrumbs=array(

	'Guest Ledgers'=>array('index'),

	'Create',

);



$this->menu=array(

	//array('label'=>'List GuestLedger', 'url'=>array('index')),

	//array('label'=>'Manage GuestLedger', 'url'=>array('admin')),

);

?>



<?php 

/* $criteria = new CDbCriteria;

$criteria->select = 'id, company_id, sum(balance) AS balance';

$criteria->compare('btc',3);

$criteria->addCondition('company_id',$model->company_id); */





$res = GuestLedger::model()->find($criteria); 

$sql = "select sum(balance) AS balance from hms_guest_ledger where btc=3 AND balance > 0 AND company_id = $model->company_id";

$totalOverdue =Yii::app()->db->createCommand($sql)->queryScalar();

//while($row = mysql_fetch_array($res)){$b = $row[balance];}



//echo "--".$totalOverdue;







?>



<h1><?php echo Yii::t('views','Get BTC Payment -') ?> <?php echo Company::model()->find("comp_id = $model->company_id")->comp_name ?></h1>



<p style="color:#900"><?php echo Yii::t('views','Below is the list of over due bills. Please select bills which are being paid now. Bill amount will be auto calculated.') ?></p>

<script>

function updateFolios(x){ 	

	var values = [];

	var formobj = document.forms[0];	

	var counter = 0;

	for (var j = 0; j < formobj.elements.length; j++){

		if (formobj.elements[j].type == "checkbox"){

			if (formobj.elements[j].checked){							

				values.push(formobj.elements[j].value);				

				document.getElementById('GuestLedger_folioids').value = values.join("-");

				calculateTotal();

				counter++;

			}else if(counter==0)document.getElementById('GuestLedger_debit').value = 0;

		}       

	}

}



function calculateTotal(){ 

	var str = document.getElementById('GuestLedger_folioids').value;	

	var n=str.split("-");

	var total=0;

	for(var i=0; i < n.length; i++){	

		 total += parseInt(document.getElementById(n[i]).textContent);

	}

	//alert('af8r'+str);

	document.getElementById('GuestLedger_debit').value = total;

	//("#GuestLedger_debit").val(tot);

}

</script>

<form name="frm3" >

<table id="tbl_folio" width="200" style=" border: 1 solid; border-color: #930 !important">

  <tr>

    <th>&nbsp;<?php echo Yii::t('views','S#') ?></th>

    <th>&nbsp; <?php echo Yii::t('views','Select') ?></th>

    <th>&nbsp; <?php echo Yii::t('views','Room No') ?></th>

    <th>&nbsp; <?php echo Yii::t('views','Guest Name') ?></th>

    <th>&nbsp; <?php echo Yii::t('views','Checkin Date') ?></th>

    <th>&nbsp; <?php echo Yii::t('views','Checkout Date') ?></th>

    <th>&nbsp;<?php echo Yii::t('views','Folio No') ?></th>

    <th>&nbsp; <?php echo Yii::t('views','Amount') ?></th>

  </tr>

<?php

$branch_id = yii::app()->user->branch_id;

$GuestLedger = GuestLedger::model()->findAll(" btc='3' AND balance > 0 and company_id = $model->company_id and branch_id = $branch_id");

	$i=0;	 	 $total_balance=0;

	foreach($GuestLedger as $rs){

	 $i++;

	 $room_no = RoomMaster::model()->find("mst_room_id=".$rs['room_id'])->mst_room_name;

	 $guest_name = $rs['guest_name'];

	 $folio=$rs['chkin_id'];

	  $chkin_date=$rs['chkin_date'];

	  $chkout_date=$rs['chkout_date'];

	 $balance=$rs['balance'];	 

	 $total_balance +=$balance;

	 

	?>

    <tr>

    <td>&nbsp;<?php echo $i; ?></td>

    <td>&nbsp;<input type="checkbox" name="cb"  value="<?php echo $folio; ?>" onclick="updateFolios(this.value)" /></td>

    <td>&nbsp;<?php echo $room_no; ?></td>

    <td>&nbsp;<?php echo ucwords(strtolower($guest_name)); ?></td>

    <td>&nbsp;<?php echo $chkin_date; ?></td>

    <td>&nbsp;<?php echo $chkout_date; ?></td>

    <td>&nbsp;<?php echo $folio; ?></td>

    <td id="<?php echo $folio; ?>">&nbsp;<?php echo $balance; ?></td>

  </tr>

    

    <?php 	

	}

	?>

     <tr>  

     <td colspan="4">&nbsp;</td>  

    <td colspan="3">&nbsp;<b> <?php echo Yii::t('views','Total Amount (In Rs.)') ?></b></td>

    <td>&nbsp;<b><?php echo $total_balance.".00"; ?></b></td>

  </tr>

</table>

</form>



<?php if(isset($errors)){ echo "<p style=\"color:#F00; \">".$errors."</p>"; 	} ?>



<fieldset style="background-color:#999"><legend><h3> <?php echo Yii::t('views','Payment Details') ?> </h3></legend>

<?php $form=$this->beginWidget('CActiveForm', array(

	'id'=>'guest-ledger-form',

	'enableAjaxValidation'=>false,

)); ?>



	<p class="note"><?php echo Yii::t('views','Bill Payment - Fields with') ?> <?php echo Yii::t('views','<span class="required">*</span> are required.') ?></p>



	<?php echo $form->errorSummary($model); ?>

    

    <input type="hidden" name="GuestLedger[folioids]" id="GuestLedger_folioids" value="" />

    <input type="hidden" name="GuestLedger[company_id]" id="GuestLedger_company_id" value="<?php echo $model->company_id; ?>" />

    <table width="488" border="2">

    <tr>

    <td width="65">&nbsp;</td>    

    <td width="313">&nbsp;

	<div class="row">

		<?php echo $form->labelEx($model,'service_id'); ?>

		<?php //echo $form->textField($model,'service_id'); ?>

         <?php 

		$branch_id = yii::app()->user->branch_id;

		 echo $form->dropDownList($model,'service_id', CHtml::listData(Services::model()->findAll("service_description LIKE 'Paid' AND branch_id=$branch_id"), 'service_id', 

		'service_description'),array('class'=>'chzn-select')); ?>

		<?php echo $form->error($model,'service_id'); ?>

	</div>

	</td>

    <td width="14">&nbsp;</td>

    </tr>

    

     <tr>

    <td>&nbsp;</td>    

    <td>&nbsp;

    <div class="row"> 

    	<label class="required" for="GuestLedger_service_id"><?php echo Yii::t('views','Service') ?></label>       

        <?php 	

		$paymentMethod = array('0'=>'Cash','1'=>'Debit Card','2'=>'Credit Card');		

		echo $form->dropDownList($model, 'btc', $paymentMethod);?>		

		<?php //echo $form->error($model,'debit'); ?>

	</div>

	</td>

    <td>&nbsp;</td>

    </tr>

	<tr>

    <td>&nbsp;</td>    

    <td>&nbsp;

	<div class="row">

		<?php echo $form->labelEx($model,'debit'); ?>

		<?php echo $form->textField($model,'debit', array('value'=>0)); ?>

		<?php echo $form->error($model,'debit'); ?>

	</div>

	</td>

    <td>&nbsp;</td>

    </tr>

    <tr>

    <td>&nbsp;</td>    

    <td>&nbsp;

	<div class="row">

		<?php echo $form->labelEx($model,'remarks'); ?>

		<?php echo $form->textField($model,'remarks',array('size'=>15,'maxlength'=>30)); ?>

		<?php echo $form->error($model,'remarks'); ?>

	</div>

	</td>

    <td>&nbsp;</td>

    </tr>

	

	

	<tr>

    <td>&nbsp;</td>    

    <td>&nbsp;

	<div class="row">

		<?php $hotel_branch_id = yii::app()->user->branch_id;?>

		<?php //echo $form->labelEx($model,'branch_id'); ?>

		<?php echo $form->hiddenField($model,'branch_id',array('value'=>$hotel_branch_id)); ?>

		<?php echo $form->error($model,'branch_id'); ?>

	</div>



	<div class="row buttons">

		<?php echo CHtml::submitButton($model->isNewRecord ? ' OK ' : ' OK '); ?>

	</div></td><td>&nbsp;</td></tr>

	<tr>

    <td>&nbsp;</td>    

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    </tr></td></table>

<?php $this->endWidget(); ?>



</fieldset>

