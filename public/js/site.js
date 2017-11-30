$(document).ready(function(){
	// var nav_to_top = $('.navigation-menu').offset().top;
	//alert(nav_to_top);
	// if($(this).scrollTop() > nav_to_top){
	//     	$('.navigation-menu').css({
	//     		'position':'fixed',
	//     		'top':'0px',
	//     		'z-index':'98',
	//     		'width':'100%'
	//     	});
	//     	$('#main-content').css({
	//     		'margin-top': '70px'
	//     	});
	//     }
	//     else{
	//     	$('.navigation-menu').css({
	//     		'position':'static'
	//     	});
	//     	$('#main-content').css({
	//     		'margin-top': '0px'
	//     	});
	//     }
	$(window).scroll(function() {
	    if ($(this).scrollTop() >= 200) {
	        $('#back_to_top').fadeIn(200);
	    } else {
	        $('#back_to_top').fadeOut(200);
	    }
	    // if($(this).scrollTop() > nav_to_top){
	    // 	$('.navigation-menu').css({
	    // 		'position':'fixed',
	    // 		'top':'0px',
	    // 		'z-index':'98',
	    // 		'width':'100%'
	    // 	});
	    // 	$('#main-content').css({
	    // 		'margin-top': '70px'
	    // 	});
	    // }
	    // else{
	    // 	$('.navigation-menu').css({
	    // 		'position':'static'
	    // 	});
	    // 	$('#main-content').css({
	    // 		'margin-top': '0px'
	    // 	});
	    // }
	});
	$('#back_to_top').click(function() {
	    $('body,html').animate({
	        scrollTop : 0
	    }, 500);
	});

	
});
