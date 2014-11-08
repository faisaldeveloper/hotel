<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div id="content" style="min-height:auto">
		<?php echo $content; ?>
	</div><!-- content -->
    
   <div align="center">
		<?php			
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
		?>
        </div>
		 
</div>
<?php $this->endContent(); ?>