$(document).ready(function() {
	$('input[type=radio][name=changeImg]').change(function() {
        if (this.value == 1) {
            $("#imgChange").html('<input type="file" id="imageProduct" name="imageProduct" value="" required="required" style="padding: 5px;" accept="image/*">');
            $('#pre_img').show();
        }
        else if (this.value == 2) {
            $("#imgChange").html('');
            $('#pre_img').hide();
        }
        $("#imageProduct").change(function(){
		    readURL(this);
		});
    });

	$('input[type=radio][name=img_rotate]').change(function() {
        var r = this.value;
        $("#pre_img").css({
        	'-ms-transform': 'rotate('+ r +'deg)', /* IE 9 */
		    '-webkit-transform': 'rotate('+ r +'deg)', /* Chrome, Safari, Opera */
		    'transform': 'rotate('+ r +'deg)'
        });
    });

	$( "#txtPrice" ).keyup(function() {
		var format_price = $( "#txtPrice" ).val();
		format_price = format(parseInt(format_price));
		$("#format_price").text(format_price + 'đ');
	});

	$( "#txtDiscount" ).keyup(function() {
		var format_price = $( "#txtDiscount" ).val();
		format_price = format(parseInt(format_price));
		$("#format_discount").text(format_price + 'đ');
	});

	function format(n) {
	    return n.toFixed(0).replace(/./g, function(c, i, a) {
	        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
	    });
	}
    function readURL(input) {
    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	          	reader.onload = function (e) {
	            $('#pre_img').attr('src', e.target.result);
	        }
          	reader.readAsDataURL(input.files[0]);
      	}
  	}
	$("#imageProduct").change(function(){
	    readURL(this);
	});
	$("#logoUpload").change(function(){
	    readURL(this);
	});
	$("#slideUpload").change(function(){
	    readURL(this);
	});

	$("#addSlide").click(function () {
        $("#form_add_slide").show();
    });
    $("#cancelAddSlide").click(function () {
        $("#form_add_slide").hide();
    });

});
