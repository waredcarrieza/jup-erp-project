function show_action_button(idx){
	$(".action_button_subparent_"+idx).show();
}

function hide_action_button(idx){
	$(".action_button_subparent_"+idx).hide();
}

function toggleAllowPassword(myClass, obj) {
    var $input = $(obj);
    if ($input.prop('checked')) $(myClass).show();
    else $(myClass).hide();
}

function showNotif(title_text, text_content, class_type){
	$.gritter.add({
		title: title_text,
		text: text_content,
		class_name: class_type,
		position: 'center'
	});
}

function refreshPage(){
    window.location.reload();
}

function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}

$(document).ready(function(){
	"use strict";
	
	var $totop 	= '1'; // 0 is false and 1 is true.

	/* ================ Begin Back to top button. ================ */
	var ScrlTop = $(window).scrollTop();
	
	if($totop == '0'){
		$('#to-top').css('display','none');
	}else{
		if (ScrlTop > 200) {
			$('#to-top').fadeIn();
		} else {
			$('#to-top').fadeOut();
		}	
	}

	$('#to-top').on("click",function(){
		$('html, body').animate({scrollTop: '0px'}, 800);
		return false;
	});
	/* ================ End Back to top button. ================ */

	/* ================ Begin window.scroll functions. ================ */
	$(window).on("scroll",function(){
			
		var ScTop = $(this).scrollTop();
		
		if($totop == '0'){
			$('#to-top').css('display','none');
		}else{
			if (ScTop > 100) {
				$('#to-top').fadeIn();
				
			} else {
				$('#to-top').fadeOut();
				
			}	
		}
		
	});
	/* ================ End window.scroll functions. ================ */

	$(document).on('click', '.wa-direct-nav', function(e) {
        // target element id
        var id = $(this).attr('href');
        // target element
        var $id = $(id);
        if ($id.length === 0) {
            return;
        }
        // prevent standard hash navigation (avoid blinking in IE)
        e.preventDefault();
        // top position relative to the document - 1 rem (16px)
        var pos = ($id.offset().top - 16);
        // animated top scrolling
        $('body, html').animate({scrollTop: pos});
    });

	$('.dropdown-submenu a.submenu-item').on("mouseover", function(e){
	    $(this).next('ul').toggle();
	    e.stopPropagation();
	    e.preventDefault();
	  });

	$('.dropdown-submenu').mouseleave(function () {
	    $(".mysubmenu-item").toggle();
	  });

	if($(".date-picker").length){
		$(".date-picker").datepicker({
			dateFormat: "dd-mm-yy"
		});
	}
	
	if($(".timepicker-24").length){
		$(".timepicker-24").timepicker({
			format: "H:i a"
		});
	}
	
	$(document).on("click", '.open_change_datetime', function(){
		$('.open_change_datetime').hide();
		$('.change_post_date').show();
	});
	
	$(document).on("click", '.close_change_datetime', function(){
		$('.change_post_date').hide();
		$('.open_change_datetime').show();
	});
	
	$(document).on("click", '.slug_change_ok', function(){
		$('.slug_change_ok').hide();
		$('.slug_text').hide();
		$('.slug_change_no, .slug_box, .slug_change_button').show();
		$('.slug_box').focus();
	});
	
	$(document).on("click", '.slug_change_no', function(){
		$('.slug_change_no').hide();
		$('.slug_box, .slug_change_button').hide();
		$('.slug_change_ok, .slug_text').show();
	});

	$(".signout").click(function(){
		var goURL 	= $(this).attr('svn');
		jConfirm('Are you sure to Sign out<br />from Dashboard ?','Confirm',function(r){
			if(r){
				window.location = goURL;
			}else{
				return false;
			}
		});
	});

	$(document).on("click", ".openPopUp", function() {
		var goURL 	= $(this).attr('svn');
		var id 		= $(this).data('id');
		$.facebox.settings.overlay = 'false';
		$.facebox(function() {
			$.post(goURL+"/"+id, function(data) {
				$.facebox(data)
			})
		})
	});

	$(document).on("click", ".openPopUpId", function() {
		var goURL 	= $(this).attr('svn');
		var id 		= $(this).data('id');
		$.facebox.settings.overlay = 'false';
		$.facebox(function() {
			$.post(goURL+id, function(data) {
				$.facebox(data)
			})
		})
	});

	$(document).bind('beforeReveal.facebox', function() {
            $("#facebox .content").empty();
    });
	
	$(document).on('mouseover', "#facebox",function(){
		//$("#facebox ").draggable({});
		$("#facebox #facebox_top_title").css('cursor','move');
	});

	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl)
	})
});