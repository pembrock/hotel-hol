	$(function() {
	//SVG Fallback
	if(!Modernizr.svg) {
		$("img[src*='svg']").attr("src", function() {
			return $(this).attr("src").replace(".svg", ".png");
		});
	};

	//E-mail Ajax Send
	//Documentation & Example: https://github.com/agragregra/uniMail
	$("#myForm").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "/inc/pages/review.php", //Change
			data: th.serialize(),
			success: function(e){
				var e = $.parseJSON(e);
				if (e.ok == 1){
					$('#info').html('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><span>Отзыв успешно отправлен и будет опубликован после рассмотрения!</span></div>');
					$('#myForm')[0].reset();
					$('#myForm').hide();
				}
				else{
					$('#info').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><span>Произошла непредвиденная ошибка!</span></div>');
				}
			}
		});
		return false;
	});

	//Chrome Smooth Scroll
	try {
		$.browserSelector();
		if($("html").hasClass("chrome")) {
			$.smoothScroll();
		}
	} catch(err) {

	};

	$("img, a").on("dragstart", function(event) { event.preventDefault(); });
	
});

	$(window).load(function() {

		$(".loader_inner").fadeOut();
		$(".loader").delay(400).fadeOut("slow");

	});

$(document).ready(function(){
        var $menu = $("#menu");
        $(window).scroll(function(){
            if ( $(this).scrollTop() > 100 && $menu.hasClass("default") ){
                $menu.removeClass("default").addClass("fixed");
            } else if($(this).scrollTop() <= 100 && $menu.hasClass("fixed")) {
                $menu.removeClass("fixed").addClass("default");
            }
        });//scroll

	//страница номера и цены
	$('select[name=guests]').on('change', function(){
		var guests = $(this).val();
		var tid = $('select[name=tariff]').val();
		$.ajax({
			type: "POST",
			url: "/prices",
			data: {getRates: 1, guests: guests, tid: tid},
			success: function(e){
				var response = JSON.parse(e);
				$('.color_4').html(response['description']);
				for (var key in response) {
					if (key != 'description' && response[key] != null)
						$('.' + key).text(response[key]);
					else
						$('.' + key).text('');
				}
			}
		});

	});

	$('select[name=tariff]').on('change', function(){
		var guests = $('select[name=guests]').val();
		var tid = $(this).val();
		$.ajax({
			type: "POST",
			url: "/prices",
			data: {getRates: 1, guests: guests, tid: tid},
			success: function(e){
				var response = JSON.parse(e);
				$('.color_4').html(response['description']);
				for (var key in response) {
					if (key != 'description' && response[key] != null)
						$('.' + key).text(response[key]);
					else
						$('.' + key).text('');
				}
			}
		});
	});

	size_li = $(".commentList li").size();
	x=3;
	$('.commentList li:lt('+x+')').show();
	$('#loadMore').click(function () {
		x= (x+5 <= size_li) ? x+5 : size_li;
		$('.commentList li:lt('+x+')').show();
		$('html, body').animate({
			scrollTop: $("#addReview").offset().top
		}, 2000);
	});
	$('#showLess').click(function () {
		x=(x-5<0) ? 3 : x-5;
		$('.commentList li').not(':lt('+x+')').hide();
	});

    $('.commentTextBlock').shorten({
        moreText: 'читать полностью',
        lessText: 'свернуть'
    });

    });