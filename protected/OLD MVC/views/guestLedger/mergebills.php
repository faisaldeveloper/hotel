<form id="merge-folio-form" method="post" action="/hotel/GuestLedger/mergebills" target="_blank">

<?php
 $this->widget('ext.widgets.multiselects.XMultiSelects',array(
    'leftTitle'=>'Checkied-in Guests',
    'leftName'=>'CheckinInfo[single][]',
    'leftList'=>CheckinInfo::model()->findCheckedIn(0),
    'rightTitle'=>'Merge These Folios',
    'rightName'=>'CheckinInfo[merge][]',
    'rightList'=>CheckinInfo::model()->findCheckedIn(1),
    'size'=>20,
    'width'=>'200px',
));
?>



<?php 
$this->widget('zii.widgets.jui.CJuiButton', array(
    'buttonType'=>'submit',
    'name'=>'btnSubmit',
    'value'=>'1',
    'caption'=>'Submit',
    'htmlOptions'=>array('class'=>'ui-button-primary')
));
?>
</form>