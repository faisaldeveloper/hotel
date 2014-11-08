<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	
	<!--<div align="right" style="padding-right:20px;">
	<?php			
			  /* $this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));   */
			
			
		?>
	 </div>-->
    
    <div id="content" style="min-height:auto">
		<?php echo $content; ?>
	</div><!-- content -->
    
   
		
       
		 
</div>
<?php $this->endContent(); ?>