// $(document).ready(function () {
$(window).on('load', function(){

	let direction = document.getElementsByName('direction')[0].content;
	let assetURL = document.getElementsByName('frontendAssetURL')[0].content;
	let imageLoader = document.getElementsByName('image-loader')[0].content;
	$('.banner_js').slick({
		arrows: false,
		dots: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		horizontal: true,
		infinite: true,
		autoplay: true,
		arrows:false,
		// nextArrow: '<div class="slick-custom-arrow-right"><i class="fa fa-angle-right"></i></div>',
    //  prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="fa fa-angle-left"></i></div>',
		fade: true,
		rtl: direction == 1 ? true : false,
		pauseOnHover: false,
		autoplaySpeed: 5000,
		customPaging : function(slider, i) {
	    return `<a href="#">
				<div class="inactive-dots"></div>
				<div class="active-dots"></div>
			</a>`;
	  },
		responsive: [
			{
				breakpoint: 601,
				settings: {
					arrows: false,
				}
			}
		]
	});
	$('.banner_js').fadeIn();
	$('.customer-js').slick({
		arrows: false,
		dots: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		horizontal: true,
		infinite: true,
		autoplay: true,
		pauseOnHover: false,
		autoplaySpeed: 3000,
		rtl: direction == 1 ? true : false,
		responsive: [
			{
				breakpoint: 1500,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});


		$('.today-offer-js').slick({
			arrows: true,
			dots: false,
			slidesToShow: 3,
			slidesToScroll: 1,
			horizontal: true,
			infinite: true,
			autoplay: false,
			pauseOnHover: false,
			autoplaySpeed: 3000,
			rtl: direction == 1 ? true : false,

			responsive: [
				{
					breakpoint: 1120,
					settings: {
						slidesToShow: 3
					}
				},
				{
					breakpoint: 820,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 500,
					settings: {
						slidesToShow:1
					}
				}
			]
	});


	$('.releted-product-js').slick({
		arrows: false,
		dots: false,
		slidesToShow: 5,
		slidesToScroll: 1,
		horizontal: false,
		infinite: true,
		autoplay: true,
		pauseOnHover: true,
		autoplaySpeed: 3000,
		rtl: direction == 1 ? true : false,
		responsive: [
				{
					breakpoint: 1500,
					settings: {
						slidesToShow: 4
					}
				},

				{
					breakpoint: 720,
					settings: {
						slidesToShow: 2
					}
				},

				{
					breakpoint: 920,
					settings: {
						slidesToShow: 3
					}
				},
				{
					breakpoint: 500,
					settings: {
						slidesToShow:1
					}
				}
		]
});

		$('.sepcial-product-js').slick({
			arrows: true,
			dots: false,
			slidesToShow: 4,
			slidesToScroll: 1,
			horizontal: false,
			rtl: direction == 1 ? true : false,
			infinite: true,
			autoplay: true,
			pauseOnHover: true,
			autoplaySpeed: 3000,
			responsive: [
					{
						breakpoint: 1500,
						settings: {
							slidesToShow: 4
						}
					},
					{
						breakpoint: 820,
						settings: {
							slidesToShow: 3
						}
					},
					{
						breakpoint: 720,
						settings: {
							slidesToShow: 2
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow:1
						}
					}
			]
	});


			$('.new-product-js').slick({
				arrows: true,
				dots: false,
				slidesToShow: 5,
				slidesToScroll: 1,
				horizontal: true,
				infinite: true,
				autoplay: true,
				pauseOnHover: false,
				rtl: direction == 1 ? true : false,

				autoplaySpeed: 300000,
				responsive: [
					{
						breakpoint: 1500,
						settings: {
							slidesToShow: 4
						}
					},
					{
						breakpoint: 820,
						settings: {
							slidesToShow: 3
						}
					},
					{
						breakpoint: 720,
						settings: {
							slidesToShow: 2
						}
					},
					{
						breakpoint: 1280,
						settings: {
							slidesToShow: 4
						}
					},
					{
						breakpoint: 500,
						settings: {
							slidesToShow:1
						}
					}
				]
		});

		$('.new-product-js').fadeIn();


		$('.categories-js').slick({
			arrows: true,
			dots: false,
			slidesToShow: 6,
			slidesToScroll: 1,
			horizontal: true,
			infinite: true,
			autoplay: false,
			pauseOnHover: false,
			autoplaySpeed: 3000,
			rtl: direction == 1 ? true : false,
			responsive: [
				{
					breakpoint: 1500,
					settings: {
						slidesToShow: 4
					}
				},
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 3
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow:2
					}
				},
				{
					breakpoint: 500,
					settings: {
						slidesToShow:1
					}
				}
			]
	});

	$('.categories-js').fadeIn();


	$('.brand-js').slick({
		arrows: true,
		dots: false,
		slidesToShow: 6,
		slidesToScroll: 1,
		horizontal: true,
		infinite: true,
		autoplay: false,
		pauseOnHover: false,
		rtl: direction == 1 ? true : false,

		autoplaySpeed: 3000,
		responsive: [
			{
				breakpoint: 1500,
				settings: {
					slidesToShow: 4
				}
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow:1
				}
			},
			{
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
			{
					 breakpoint: 480,
					 settings: {
							 slidesToShow: 2,
							 slidesToScroll: 1
					 }
			 }

		]
});

});
