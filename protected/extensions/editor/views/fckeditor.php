<SCRIPT type="text/javaSCRIPT" src="<?php echo $this->path; ?>/fckeditor.js"></SCRIPT>
<SCRIPT type="text/javaSCRIPT">
        var oFCKeditor = new FCKeditor("<?php echo $this->name; ?>");
        oFCKeditor.ToolbarSet="<?php echo $this->toolbar; ?>";
		oFCKeditor.Height = <?php echo $this->height; ?>;
        oFCKeditor.BasePath="<?php echo $this->path; ?>/";
        oFCKeditor.ReplaceTextarea();
</SCRIPT>
