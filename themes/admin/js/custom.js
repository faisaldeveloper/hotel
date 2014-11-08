var jq = $.noConflict();

jq(document).ready(function(){
	
	prettyPrint();			//syntax highlighter
	mainwrapperHeight();
	responsive();
	
	
	// animation
	if(jq('.contentinner').hasClass('content-dashboard')) {
		var anicount = 4;	
		jq('.leftmenu .nav-tabs > li').each(function(){										   
			jq(this).addClass('animate'+anicount+' fadeInUp');
			anicount++;
		});
		
		jq('.leftmenu .nav-tabs > li a').hover(function(){
			jq(this).find('span').addClass('animate0 swing');
		},function(){
			jq(this).find('span').removeClass('animate0 swing');
		});
		
		jq('.logopanel').addClass('animate0 fadeInUp');
		jq('.datewidget, .headerpanel').addClass('animate1 fadeInUp');
		jq('.searchwidget, .breadcrumbwidget').addClass('animate2 fadeInUp'); 
		jq('.plainwidget, .pagetitle').addClass('animate3 fadeInUp');
		jq('.maincontent').addClass('animate4 fadeInUp');
	}
	
	// widget icons dashboard
	if(jq('.widgeticons').length > 0) {
		jq('.widgeticons a').hover(function(){
			jq(this).find('img').addClass('animate0 bounceIn');
		},function(){
			jq(this).find('img').removeClass('animate0 bounceIn');
		});	
	}


	// adjust height of mainwrapper when 
	// it's below the document height
	function mainwrapperHeight() {
		var windowHeight = jq(window).height();
		var mainWrapperHeight = jq('.mainwrapper').height();
		var leftPanelHeight = jq('.leftpanel').height();
		if(leftPanelHeight > mainWrapperHeight)
			jq('.mainwrapper').css({minHeight: leftPanelHeight});	
		if(jq('.mainwrapper').height() < windowHeight)
			jq('.mainwrapper').css({minHeight: windowHeight});
	}
	
	function responsive() {
		
		var windowWidth = jq(window).width();
		
		// hiding and showing left menu
		if(!jq('.showmenu').hasClass('clicked')) {
			
			if(windowWidth < 960)
				hideLeftPanel();
			else
				showLeftPanel();
		}
		
		// rearranging widget icons in dashboard
		if(windowWidth < 768) {
			if(jq('.widgeticons .one_third').length == 0) {
				var count = 0;
				jq('.widgeticons li').each(function(){
					jq(this).removeClass('one_fifth last').addClass('one_third');
					if(count == 2) {
						jq(this).addClass('last');
						count = 0;
					} else { count++; }
				});	
			}
		} else {
			if(jq('.widgeticons .one_firth').length == 0) {
				var count = 0;
				jq('.widgeticons li').each(function(){
					jq(this).removeClass('one_third last').addClass('one_fifth');
					if(count == 4) {
						jq(this).addClass('last');
						count = 0;
					} else { count++; }
				});	
			}
		}
	}
	
	// when resize window event fired
	jq(window).resize(function(){
		mainwrapperHeight();
		responsive();
	});
	
	// dropdown in leftmenu
	jq('.leftmenu .dropdown > a').click(function(){
		if(!jq(this).next().is(':visible'))
			jq(this).next().slideDown('fast');
		else
			jq(this).next().slideUp('fast');	
		return false;
	});
	
	// hide left panel
	function hideLeftPanel() {
		jq('.leftpanel').css({marginLeft: '-260px'}).addClass('hide');
		jq('.rightpanel').css({marginLeft: 0});
		jq('.mainwrapper').css({backgroundPosition: '-260px 0'});
		jq('.footerleft').hide();
		jq('.footerright').css({marginLeft: 0});
	}
	
	// show left panel
	function showLeftPanel() {
		jq('.leftpanel').css({marginLeft: '0px'}).removeClass('hide');
		jq('.rightpanel').css({marginLeft: '260px'});
		jq('.mainwrapper').css({backgroundPosition: '0 0'});
		jq('.footerleft').show();
		jq('.footerright').css({marginLeft: '260px'});
	}
	
	// show and hide left panel
	jq('.showmenu').click(function() {
		jq(this).addClass('clicked');
		if(jq('.leftpanel').hasClass('hide'))
			showLeftPanel();
		else
			hideLeftPanel();
		return false;
	});
	
	// transform checkbox and radio box using uniform plugin
	if(jq().uniform)
		jq('input:checkbox, input:radio, select.uniformselect').uniform();
	
	
	// show/hide widget content or widget content's child	
	if(jq('.showhide').length > 0 ) {
		jq('.showhide').click(function(){
			var t = jq(this);
			var p = t.parent();
			var target = t.attr('href');
			target = (!target)? p.next() :	p.next().find('.'+target);
			t.text((target.is(':visible'))? 'View Source' : 'Hide Source');
			(target.is(':visible'))? target.hide() : target.show(100);
			return false;
		});
	}
	
	
	// check all checkboxes in table
	if(jq('.checkall').length > 0) {
		jq('.checkall').click(function(){
			var parentTable = jq(this).parents('table');										   
			var ch = parentTable.find('tbody input[type=checkbox]');										 
			if(jq(this).is(':checked')) {
			
				//check all rows in table
				ch.each(function(){ 
					jq(this).attr('checked',true);
					jq(this).parent().addClass('checked');	//used for the custom checkbox style
					jq(this).parents('tr').addClass('selected'); // to highlight row as selected
				});
							
			
			} else {
				
				//uncheck all rows in table
				ch.each(function(){ 
					jq(this).attr('checked',false); 
					jq(this).parent().removeClass('checked');	//used for the custom checkbox style
					jq(this).parents('tr').removeClass('selected');
				});	
				
			}
		});
	}
	
	
	// delete row in a table
	if(jq('.deleterow').length > 0) {
		jq('.deleterow').click(function(){
			var conf = confirm('Continue delete?');
			if(conf)
				jq(this).parents('tr').fadeOut(function(){
					jq(this).remove();
					// do some other stuff here
				});
			return false;
		});	
	}
	
	
	// dynamic table
	if(jq('#dyntable').length > 0) {
		jq('#dyntable').dataTable({
			"sPaginationType": "full_numbers",
			"aaSortingFixed": [[0,'asc']],
			"fnDrawCallback": function(oSettings) {
				jq.uniform.update();
			}
		});
	}
	
	
	/////////////////////////////// ELEMENTS.HTML //////////////////////////////
	
	
	// tabbed widget
	jq('#tabs, #tabs2').tabs();
	
	// accordion widget
	jq('#accordion, #accordion2').accordion({heightStyle: "content"});
	
	
	// color picker
	if(jq('#colorpicker').length > 0) {
		jq('#colorSelector').ColorPicker({
			onShow: function (colpkr) {
				jq(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				jq(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				jq('#colorSelector span').css('backgroundColor', '#' + hex);
				jq('#colorpicker').val('#'+hex);
			}
		});
	}

	
	// date picker
	if(jq('#datepicker').length > 0)
		jq( "#datepicker" ).datepicker();
		
	
	// growl notification
	if(jq('#growl').length > 0) {
		jq('#growl').click(function(){
			jq.jGrowl("Hello world!");
		});
	}
	
	// another growl notification
	if(jq('#growl2').length > 0) {
		jq('#growl2').click(function(){
			var msg = "This notification will live a little longer.";
			jq.jGrowl(msg, { life: 5000});
		});
	}

	// basic alert box
	if(jq('.alertboxbutton').length > 0) {
		jq('.alertboxbutton').click(function(){
			jAlert('This is a custom alert box', 'Alert Dialog');
		});
	}
	
	// confirm box
	if(jq('.confirmbutton').length > 0) {
		jq('.confirmbutton').click(function(){
			jConfirm('Can you confirm this?', 'Confirmation Dialog', function(r) {
				jAlert('Confirmed: ' + r, 'Confirmation Results');
			});
		});
	}
	
	// promptbox
	if(jq('.promptbutton').length > 0) {
		jq('.promptbutton').click
		(function(){
			jPrompt('Type something:', 'Prefilled value', 'Prompt Dialog', function(r) {
				if( r ) alert('You entered ' + r);
			});
		});
	}
	
	// alert with html
	if(jq('.alerthtmlbutton').length > 0) {
		jq('.alerthtmlbutton').click(function(){
			jAlert('You can use HTML, such as <strong>bold</strong>, <em>italics</em>, and <u>underline</u>!');
		});
	}
	
	// sortable list
	if(jq('#sortable').length > 0)
		jq("#sortable").sortable();
	
	// sortable list with content-->
	if(jq('#sortable2').length > 0) {
		jq("#sortable2").sortable();
		jq('.showcnt').click(function(){
			var t = jq(this);
			var det = t.parents('li').find('.details');
			if(!det.is(':visible')) {
				det.slideDown();
				t.removeClass('icon-arrow-down').addClass('icon-arrow-up');
			} else {
				det.slideUp();
				t.removeClass('icon-arrow-up').addClass('icon-arrow-down');
			}
		});
	}
	
	// tooltip sample
	if(jq('.tooltipsample').length > 0)
		jq('.tooltipsample').tooltip({selector: "a[rel=tooltip]"});
		
	jq('.popoversample').popover({selector: 'a[rel=popover]', trigger: 'hover'});
	
	
	
	///// MESSAGES /////	
	
	if(jq('.mailinbox').length > 0) {
		
		// star
		jq('.msgstar').click(function(){
			if(jq(this).hasClass('starred'))
				jq(this).removeClass('starred');
			else
				jq(this).addClass('starred');
		});
		
		//add class selected to table row when checked
		jq('.mailinbox tbody input:checkbox').click(function(){
			if(jq(this).is(':checked'))
				jq(this).parents('tr').addClass('selected');
			else
				jq(this).parents('tr').removeClass('selected');
		});
		
		// trash
		if(jq('.msgtrash').length > 0) {
			jq('.msgtrash').click(function(){
				var c = false;
				var cn = 0;
				var o = new Array();
				jq('.mailinbox input:checkbox').each(function(){
					if(jq(this).is(':checked')) {
						c = true;
						o[cn] = jq(this);
						cn++;
					}
				});
				if(!c) {
					alert('No selected message');	
				} else {
					var msg = (o.length > 1)? 'messages' : 'message';
					if(confirm('Delete '+o.length+' '+msg+'?')) {
						for(var a=0;a<cn;a++) {
							jq(o[a]).parents('tr').remove();	
						}
					}
				}
			});
		}
	}

	
	// change layout
	jq('.skin-layout').click(function(){
		jq('.skin-layout').each(function(){ jq(this).parent().removeClass('selected'); });
		if(jq(this).hasClass('fixed')) {
			jq('.mainwrapper').removeClass('fullwrapper');
			if(jq('.stickyheaderinner').length > 0) jq('.stickyheaderinner').removeClass('wideheader');
			jq.cookie("skin-layout", 'fixed', { path: '/' });
		} else {
			jq('.mainwrapper').addClass('fullwrapper');
			if(jq('.stickyheaderinner').length > 0) jq('.stickyheaderinner').addClass('wideheader');
			jq.cookie("skin-layout", 'wide', { path: '/' });
		}
		return false;
	});
	
	// load selected layout from cookie
	if(jq.cookie('skin-layout')) {
		var layout = jq.cookie('skin-layout');
		if(layout == 'fixed') {
			jq('.mainwrapper').removeClass('fullwrapper');
			if(jq('.stickyheaderinner').length > 0) jq('.stickyheaderinner').removeClass('wideheader');
		} else {
			jq('.mainwrapper').addClass('fullwrapper');
			if(jq('.stickyheaderinner').length > 0) jq('.stickyheaderinner').addClass('wideheader');
		}	
	}
	
	
	// change skin color
	jq('.skin-color').click(function(){
		var s = jq(this).attr('href');
		if(jq('#skinstyle').length > 0) {
			if(s!='default') {
				jq('#skinstyle').attr('href','css/style.'+s+'.css');	
				jq.cookie('skin-color', s, { path: '/' });
			} else {
				jq('#skinstyle').remove();
				jq.cookie("skin-color", '', { path: '/' });
			}
		} else {
			if(s!='default') {
				jq('head').append('<link id="skinstyle" rel="stylesheet" href="css/style.'+s+'.css" type="text/css" />');
				jq.cookie("skin-color", s, { path: '/' });
			}
		}
		return false;
	});
	
	// load selected skin color from cookie
	if(jq.cookie('skin-color')) {
		var c = jq.cookie('skin-color');
		if(c) {
			jq('head').append('<link id="skinstyle" rel="stylesheet" href="css/style.'+c+'.css" type="text/css" />');
			jq.cookie("skin-color", c, { path: '/' });
		}
	}
	
});