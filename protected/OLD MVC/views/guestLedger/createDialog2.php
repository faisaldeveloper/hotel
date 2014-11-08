<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'licencetypeDialog2',
                'options'=>array(
                    'title'=>'Create Licence Type 2 is called',
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
					'close'=>"js:function(e,ui){
					$('body').undelegate('#closelicencetypeDialog2', 'click');
					$('#licencetypeDialog2').empty();
                 	}",
                ),
                ));
echo $this->renderPartial('_formDialog2', array('model'=>$model)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>