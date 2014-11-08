<?php $this->beginContent('/layouts/admin'); ?>
<div class="container">
	
	<div class="span-5 last">
		<div id="sidebar" style="margin-left:10px;">
			<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title'=>'<span class="icon icon-sitemap_color">Operations</span>',
				));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'operations'),
				));
				$this->endWidget();
			?>
		 <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/imgs/<?php echo rand(1, 24); ?>.jpg" alt="pic" height="170" width="170" />
	</div><!-- sidebar -->
	</div>
	
	<div class="span-19">
		<div id="content" style="min-height:200px">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	
</div>
<?php $this->endContent(); ?>