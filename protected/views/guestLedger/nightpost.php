<?php

$branch_id = yii::app()->user->branch_id;

$res = DayEnd::model()->find("branch_id= $branch_id");

$act_date = $res->active_date;

$today_date = $res->today_date;

 

$last_night_post = $res->last_night_post;

?>

<h1> <?php echo Yii::t('views','Night Post Operation :') ?> <?php echo date("F j, Y", strtotime($act_date)); ?></h1>



 <div>

<?php 

if(Yii::app()->user->checkAccess("GuestLedgerCreateRoomPost")){

	echo CHtml::button('Night Posting',array('class'=>'transferSelected-button'));

	echo "<span id=\"ajax-loading\" style=\"display:none\">  <img src=\"/hotel/images/ajax-loader.gif\" alt=\"ajax\"   /> </span>";

}

?>

</div>

<p> <?php echo Yii::t('views','Last Night Post date is') ?> <?php echo date("F j, Y H:i:s", strtotime($last_night_post));  ?> </p>





<?php

Yii::app()->clientScript->registerScript('Transfer',"

$('.transferSelected-button').click(function(){                

       if(window.confirm('Are you sure you want to Post Auto Posting?')){                  

				$(\"#ajax-loading\").show();				

                $.ajax({

                        url: '".Yii::app()->createUrl('/GuestLedger/CreateRoomPost/')."',                        

                        success: function(data){ 

								alert(data); 

								$(\"#ajax-loading\").hide();

                               /*  $.fn.yiiGridView.update('guest-ledger-grid', {

                                        data: $(this).serialize()

                                }); */

                },

                error: function(){

                // what i do on error=?

                }});

        }

        return false; // if you want to avoid default button action

});",CClientScript::POS_READY);

// Change gridview id and controller action as necessary

?>