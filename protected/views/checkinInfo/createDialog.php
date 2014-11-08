<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'licencetypeDialog',
                'options'=>array(
                    'title'=>'Create Licence Type',
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
echo $this->renderPartial('_formDialog', array('model'=>$model)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>