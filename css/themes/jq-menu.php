
 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>

<title>Filament Group Lab Example From Page from: jQuery Menu: Dropdown, iPod Drilldown, and Flyout styles with ARIA Support and ThemeRoller Ready</title>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <link rel="shortcut icon" href="/images/favicon2.ico" type="image/x-icon" />

    <link href="/style/demoPages" media="screen" rel="Stylesheet" type="text/css" />

    

    <!-- required scripts -->

    <script type="text/javascript" src="jquery-1.3.2.min.js"></script>

    <script type="text/javascript" src="fg.menu.js"></script>

    

    <!-- required styles -->

    <link type="text/css" href="fg.menu.css" media="screen" rel="stylesheet" />

    <link type="text/css" href="theme/ui.all.css" media="screen" rel="stylesheet" />

    

    <!-- styles for this example page only -->

	<style type="text/css">

	body { font-size:62.5%; }

	#menuLog { font-size:1.4em; margin:10px 20px 20px; }

	.hidden { position:absolute; top:0; left:-9999px; width:1px; height:1px; overflow:hidden; }

	

	.fg-button { clear:left; margin:0 4px 40px 20px; padding: .4em 1em; text-decoration:none !important; cursor:pointer; position: relative; text-align: center; zoom: 1; }

	.fg-button .ui-icon { position: absolute; top: 50%; margin-top: -8px; left: 50%; margin-left: -8px; }

	a.fg-button { float:left;  }

	button.fg-button { width:auto; overflow:visible; } /* removes extra button width in IE */

	

	.fg-button-icon-left { padding-left: 2.1em; }

	.fg-button-icon-right { padding-right: 2.1em; }

	.fg-button-icon-left .ui-icon { right: auto; left: .2em; margin-left: 0; }

	.fg-button-icon-right .ui-icon { left: auto; right: .2em; margin-left: 0; }

	.fg-button-icon-solo { display:block; width:8px; text-indent: -9999px; }	 /* solo icon buttons must have block properties for the text-indent to work */	

	

	.fg-button.ui-state-loading .ui-icon { background: url(spinner_bar.gif) no-repeat 0 0; }

	</style>

	

	<!-- style exceptions for IE 6 -->

	<!--[if IE]>

	<style type="text/css">

		.fg-menu-ipod .fg-menu li { width: 95%; }

		.fg-menu-ipod .ui-widget-content { border:0; }

	</style>

	<![endif]-->	

    

    <script type="text/javascript">    

    $(function(){

    	// BUTTON

    	$('.fg-button').hover(

    		function(){ $(this).removeClass('ui-state-default').addClass('ui-state-focus'); },

    		function(){ $(this).removeClass('ui-state-focus').addClass('ui-state-default'); }

    	);

    	

    	// MENU

		$.get('menuContent.html', function(data){ // grab content from another page

			$('#flyout').menu({ content: data, flyOut: true });

		});

    });

    </script>

    

    <!-- theme switcher button -->

    <script type="text/javascript" src="http://ui.jquery.com/applications/themeroller/themeswitchertool/"></script>

	<script type="text/javascript"> $(function(){ $('<div style="position: absolute; top: 20px; right: 20px;" />').appendTo('body').themeswitcher(); }); </script>

<script src="/mint/?js" type="text/javascript"></script>
</head>



<body>

<div id="demoHeader">

		<a href="/"><img src="/images/logo_examples.png" alt="Filament Group, Inc." width="141" height="26" id="logo" /></a>	

		<h1>This is an example from the Filament Group Lab Article: <a href="/lab/jquery_ipod_style_and_flyout_menus/">jQuery Menu: Dropdown, iPod Drilldown, and Flyout styles with ARIA Support and ThemeRoller Ready</a></h1>

		<p id="copyright">&copy;2012 Filament Group, Inc. All Rights Reserved.</p>

</div><!-- /demoHeader -->



<p id="menuLog">You chose: <span id="menuSelection"></span></p>



<a tabindex="0" href="menuContent.html" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flyout"><span class="ui-icon ui-icon-triangle-1-s"></span>flyout menu</a>



</body>

</html>

