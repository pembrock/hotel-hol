	$(function() {
	//SVG Fallback
	if(!Modernizr.svg) {
		$("img[src*='svg']").attr("src", function() {
			return $(this).attr("src").replace(".svg", ".png");
		});
	};

	//E-mail Ajax Send
	//Documentation & Example: https://github.com/agragregra/uniMail
	$("form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "/inc/pages/review.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Thank you!");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
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

    });