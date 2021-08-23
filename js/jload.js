//jQuery.noConflict();
//$(document).ready(function(){
//jQuery(document).ready(function($){	
//jQuery(function($){		
(function($){
//$(window).load(function(){	
//Begin	
//cssFallback
	$(function(){
		if($('.x').css('font-family') !== 'FontAwesome')
		{
			$('head').prepend('<link rel="stylesheet" type="text/css" href="http://localhost/306/css/style.css?v=a2" media="all"/>');
		}
		else
		{
			$('head').prepend('<link rel="stylesheet" type="text/css" href="http://localhost/306/css/styleb.css?v=a2" media="all"/>');
		}
	});
//EmailFrom LightBox
	// $("#cpost").click(function(e){
	// 	e.preventDefault();
	// 	//$('#cpost').attr('disabled','disabled'); //Disable button 
	// 	$('#cpost').html('Sending...'); //Change button text
	// 	var base_url = "http://localhost/306/";
	// 	var sender = $("#sender").val();	
	// 	var to = $("#to").val();
	// 	var cname = $("#cname").val();
	// 	var cmsg = $("#cmsg").val();
	// 	$("#fpanel").html("<img src=http://localhost/306/images/loading.gif><em class=false>Sending...</em>");
	// 	if(sender != "" && cmsg != "" && cname != ""){
	// 		var jqXHR = $.post(base_url+"welcome/cmail",{"cmail":sender,"to":to,"cname":cname,"cmsg":cmsg},function(){
	// 		})
	// 		.done(function(){
	// 			$("#fpanel").html("<em class=true>Message Sent!</em>");
	// 		})
	// 		.fail(function(){
	// 			$("#fpanel").html("<em class=false>Transmission Failed!</em>");
	// 		});			
	// 	}
	// 	else
	// 	{
	// 		$("#fpanel").html("<em class=false>Required Fields Missing!</em>");
	// 	}	
//Login
// div will stay hidden for 2 seconds before showing.
//$('div').hide().delay(2000).show();

//Display:block;
	$(".anchor").click(function(e){
		e.preventDefault();
		$("#lights").fadeIn(400);
		$('#data').html('<div id="loading"><img src="http://localhost/eindex310/images/loading.gif"> <em class="false">Loading...</em></div>');
		var url = 'http://localhost/eindex310/';
		var id = $(this).attr('id');
		$.post(url+'welcome/focus', {'id':id}, function(data){
			//alert(data);
		if($.trim(id != '' && data.length > 0))
			{
				$('#data').html(data);
				//$('#data').text(data);
			}		
		});	

	});
	$('.abouts').click(function(e){
		e.preventDefault();
		$('#about').fadeIn(400);
	});
//Display:none;
	$('.exit').click(function(e){
		e.preventDefault();
		//$('#lights').hide();
		$('#lights').fadeOut(400);
		$('#about').fadeOut(400);
	});
	$('#us').click(function(){$('#about').show();});	
//Empty:input;
	// $('#abc').click(function(){
	// 	$(this).remove();
	// });
//Hide Message
	$('#close').click(function(e){
		e.preventDefault();
	    $('#mini').slideUp('slow', function(){
	    $('#mini').remove();
	    });
	    return false;
	});	
//Fliper
	$("#fpanel").hide();
	$("#flip").click(function(e){
	e.preventDefault();
		$("#fpanel").slideToggle(400);
	});
//End	
//}); 
})(jQuery);
//SelectAll checkbox

//Google Translator
function googleTranslateElementInit(){
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    autoDisplay: false,
    gaTrack: true,
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
  }, 'google_translate_element');
}