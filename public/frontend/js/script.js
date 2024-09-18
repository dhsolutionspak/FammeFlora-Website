
function closeLoginModal() {
	$('#loginModal').modal('hide');
}
function closesignupModal() {
	$('#signupModal').modal('hide');
}
function closeProductModal() {
	$('#productDetailsModal').modal('hide');
}

$(document).ready(function () {
	$('.loginbtn').click(function () {
		$('#signupModal').modal('hide');
		$('#loginModal').modal('show');
	});

	$('.signupbtn').click(function () {
		$('#loginModal').modal('hide');
		$('#signupModal').modal('show');
	});

	/*Scroll top*/
	var scrollTop = $(".scrollTop");
	$(window).scroll(function () {
		var topPos = $(this).scrollTop();
		if (topPos > 0) {
			$(scrollTop).css("opacity", "1");
		} else {
			$(scrollTop).css("opacity", "0");
		}
	});
	$(scrollTop).click(function () {
		$('html, body').animate({
			scrollTop: 0
		}, 600);
		return false;
	});

	/*Menu dropdown*/
	var ico = $('<i class="fa fa-angle-down menudrop"></i>');
	$('.menu_link li:has(.submenu) > a').append(ico);
	$('.menudrop').on('click', function (e) {
		$(this).parent().parent().addClass('no-hover');

		$('.menu_link ul li').not($(this).parent().parent()).find('.submenu').stop(true, true).delay(200).fadeOut(500);
		$('.menu_link ul li').not($(this).parent().parent()).removeClass('open');
		$('.menu_link ul li a .menudrop').not($(this)).removeClass('openedmenu');
		$('.menu_link ul li a .menudrop').not($(this)).addClass('closemenu');

		e.preventDefault();
		if ($(this).hasClass('openedmenu')) {
			$(this).parent().parent().find('.submenu').stop(true, true).delay(200).fadeOut(500);
			$(this).removeClass('openedmenu');
			$(this).addClass('closemenu');

		} else {
			$(this).parent().parent().find('.submenu').stop(true, true).delay(200).fadeIn(500);
			$(this).removeClass('closemenu');
			$(this).addClass('openedmenu');
		}
	});

	if ($(window).width() >= 1120) {
		$(".menu_link nav > ul > li.has-sub").hover(
			function () {
				$('body').addClass("menuoverlay");
				$(window).trigger('resize');
			},
			function () {
				$('body').removeClass("menuoverlay");
			}
		);
	}

	$(".togglebtn, .overlay").click(function () {
		$(".togglebtn, .overlay, .menu_link").toggleClass("active");
		if ($(".overlay").hasClass("active")) {
			$(".overlay").fadeIn();
			$('html').addClass('menuhidden');
		} else {
			$(".overlay").fadeOut();
			$('html').removeClass('menuhidden');
		}
	});

	$(window).scroll(function () {
		if (($(window).scrollTop() > 200) && ($(window).width() >= 1121)) {
			$('body').addClass('fixed-header');
		} else {
			$('body').removeClass('fixed-header');
		}
	});

	$(".ft-navigation-div .heading-md").click(function () {
		if ($(window).width() < 993) {
			$(this).toggleClass("showhide");
			$(this).next().slideToggle("");
		}
	});


	/*Same height*/
	var $this = $(this);
	function serviceboxheight() {
		var max = 0;
		$('.testilist li .sbox', $this).each(function () {
			$(this).height('');
			var h = $(this).height();
			max = Math.max(max, h);
		}).height(max);

	}
	//setHeight();
	$(window).on('load resize orientationchange', serviceboxheight);



});

$(document).on("click", ".quickviewtext", function (event) {
	let productID = $(this).attr('data-product');
	let url = document.getElementsByName('baseURL')[0].content;
	let token = document.getElementsByName('csrf-token')[0].content;
	url = url + '/product-detail';
	$.ajax({
		url: url,
		type: 'post',
		data: { '_token': token, 'product_id': productID },
		dataType: 'json',
		success: function (response) {
			if (response.status == 1) {
				localStorage.clear();

				renderProductDetail(response, productID);
			}
			else {
				new RetroNotify({
					style: 'white',
					animate: 'slideTopRight',
					contentHeader: '<i class="fa fa-info"></i> Error',
					contentText: response.message,
					closeDelay: 2500
				});
			}
		}
	});
});



//ADD TO CART PRODUCT DETAILS BUTTON
$(document).on("click", ".add-to-cart", function (event) {
	event.preventDefault();

	let productID = $(this).parent().find('input[name="productID"]').val()
	let qty = $(this).parent().find('input[type="number"]').val();
	let baseurl = document.getElementsByName('baseURL')[0].content;
	let token = document.getElementsByName('csrf-token')[0].content;
	let currentRoute = document.getElementsByName('currentRoute')[0].content;
	let assetURL = document.getElementsByName('assetURL')[0].content;

	url = baseurl + '/add-to-cart';
	let optionObj = Object.create(null);

	var checkedCheckboxes = $("input.option-checkbox:checked");
	// Loop through the selected checkboxes
	checkedCheckboxes.each(function (index) {
		optionObj['optionCheckboxSelected' + index] = $(this).val();
	});


	var checkedRadioboxes = $("input.option-radio:checked");
	// Loop through the selected checkboxes
	checkedRadioboxes.each(function (index) {
		optionObj['optionRadioSelected' + index] = $(this).val();
	});

	if ($('input[name="optionColor"]:checked').val()) {
		optionObj.optionColorSelected = $('input[name="optionColor"]:checked').val();
	}
	if ($("#select" + productID).val()) {
		optionObj.optionSelectSelected = $("#select" + productID).val();
	}

	let price = 0;

	if (currentRoute == 'product.details' && !isNaN(parseFloat($('#priceproduct').text()))) {
		price = parseFloat($('#priceproduct').text())
	}

	if (currentRoute != 'product.details' && !isNaN(parseFloat($('#priceproduct' + productID).text()))) {
		price = parseFloat($('#priceproduct' + productID).text())
	}

	$.ajax({
		url: url,
		type: 'post',
		data: { '_token': token, 'product_id': productID, 'quantity': qty, "price": price, "options": Object.keys(optionObj).length > 0 ? JSON.stringify(optionObj) : null },
		dataType: 'json',
		success: function (response) {
			if (response.status == 1) {
				$('#productDetailsModal').modal('hide');

				new RetroNotify({
					style: 'green',
					animate: 'slideTopRight',
					contentHeader: '<i class="fa fa-check"></i> Success',
					contentText: response.message,
					closeDelay: 2500
				});

				$('.basket-count').text(response.cartCount);
				if ($(event.target).hasClass('buy-now')) {
					const rurl = baseurl + '/shoppingCart';
					window.location.replace(rurl);
				}
			}
			else if (response.status == 3) {

				new RetroNotify({
					style: 'white',
					animate: 'slideTopRight',
					contentHeader: '<i class="fa fa-info"></i> Failed',
					contentText: 'Product Option Required',
					closeDelay: 2500
				});

				//product Details
				if (currentRoute != 'product.details') {
					renderProductDetail(response, productID);
				}
			}
			else {
				new RetroNotify({
					style: 'white',
					animate: 'slideTopRight',
					contentHeader: '<i class="fa fa-info"></i> Error',
					contentText: response.message,
					closeDelay: 2500
				});
			}
		}
	});
});

//ADD TO CART BUTTON
$(document).on("click", ".btn-add-to-cart", function (event) {
	event.preventDefault();

	let productID = $(this).parent().find('input[name="productID"]').val()
	let qty = 1;
	let url = document.getElementsByName('baseURL')[0].content;
	let token = document.getElementsByName('csrf-token')[0].content;
	let currentRoute = document.getElementsByName('currentRoute')[0].content;
	let assetURL = document.getElementsByName('assetURL')[0].content;


	url = url + '/add-to-cart';
	let optionObj = '';
	// if($('input[name="optionCheckbox"]:checked').val()) {
	// 	optionObj.optionCheckboxSelected = $('input[name="optionCheckbox"]:checked').val();
	// }
	// if($('input[name="optionColor"]:checked').val()) {
	// 	optionObj.optionColorSelected = $('input[name="optionColor"]:checked').val();
	// }
	// if($('input[name="optionRadioSelected"]:checked').val()) {
	// 	optionObj.optionRadioSelected = $('input[name="optionRadioSelected"]:checked').val();
	// }
	// if($('input[name="optionRadio"]:checked').val()) {
	// 	optionObj.optionRadioSelected = $('input[name="optionRadio"]:checked').val();
	// }
	// if( $("#select"+productID).val()) {
	// 	optionObj.optionSelectSelected = $("#select"+productID).val();
	// }
	let price = 0;

	if (currentRoute == 'product.details' && !isNaN(parseFloat($('#priceproduct').text()))) {
		price = parseFloat($('#priceproduct').text())
	}

	if (currentRoute != 'product.details' && !isNaN(parseFloat($('#priceproduct' + productID).text()))) {
		price = parseFloat($('#priceproduct' + productID).text())
	}

	$.ajax({
		url: url,
		type: 'post',
		data: { '_token': token, 'product_id': productID, 'quantity': qty, "price": price, "options": Object.keys(optionObj).length > 0 ? JSON.stringify(optionObj) : null },
		dataType: 'json',
		success: function (response) {
			if (response.status == 1) {
				$('#productDetailsModal').modal('hide');
				new RetroNotify({
					style: 'green',
					animate: 'slideTopRight',
					contentHeader: '<i class="fa fa-check"></i> Success',
					contentText: response.message,
					closeDelay: 2500
				});

				$('.basket-count').text(response.cartCount);
			}
			else if (response.status == 3) {
				new RetroNotify({
					style: 'white',
					animate: 'slideTopRight',
					contentHeader: '<i class="fa fa-info"></i> Failed',
					contentText: 'Product Option Required',
					closeDelay: 2500
				});

				//product Details
				if (currentRoute != 'product.details') {
					renderProductDetail(response, productID);
				}
			}
			else {
				new RetroNotify({
					style: 'white',
					animate: 'slideTopRight',
					contentHeader: '<i class="fa fa-info"></i> Error',
					contentText: response.message,
					closeDelay: 2500
				});
			}
		}
	});
});

function renderProductDetail(response, productID) {
	$('.product-modal-ul').empty();
	let productData = response.productData;
	let assetURL = document.getElementsByName('assetURL')[0].content;
	let currency = document.getElementsByName('currency')[0].content;
	$(".modalImg").attr("src", assetURL + "/product/" + productData.product.image);
	$(".modalImg").attr("title", 'product image');

	//set name

	$('.modal-product-title').text(productData.product?.product_description?.name)

	//set modal and stock
	$('.modal-stock').addClass(productData.product.quantity > 0 ? 'greenclr' : 'redclr')
	$('.modal-stock').text(productData.product.quantity > 0 ? 'In Stock' : 'Out of Stock')
	$('.modal-model').text(productData.product.model)
	$(".modal-brand-logo").attr("src", assetURL + "/manufacturer/" + productData.product.product_manufacturer.image);
	$('.category-modal-title').text(productData.product.category?.name)

	let productOptions = productData.productOptions;

	let price = response.price;
	price = productData.product.price;
	let special = response.special;

	let liRender = '';
	for (var key in productOptions) {

		let title = key.split('-');

		liRender += `<li class="my-3">
         <div class="probox">
           <div class="prod-head">${title[1]}:`
		if (title[0] != 'Color') {
			liRender += `<span class="optionSelected"></span>`;
		}

		liRender += `</div><div class="prod-info">`;

		let options = productOptions[key];

		//if checkbox
		if (title[0] == 'Checkbox') {
			localStorage.removeItem('Checkbox');

			liRender += `<div class="row mt-3">`;
			for (p = 0; p < options.length; p++) {
				if (options[p].label.length == 1 || options[p].label.length == 2) {
					liRender += `<div class="col-md-1 col-1 col-sm-1  col-lg-1 mx-2">
                  <label class="check-label">
                    <input type="radio"  class="option-checkbox" name='${key}' value="${options[p].product_option_id}"  onchange="changePrice(${options[p].price},'Checkbox','${options[p].label}',${productID},null,'${key}')" >
                    <span class="checkmark-round">${options[p].label}</span>
                  </label>
                </div>`;
				}
				else {
					liRender += `<div class="col-md-4 col-sm-4 col-4 col-lg-4 mx-2">
                  <label class="check-label">${options[p].label} `;
					liRender += options[p].price > 0 ? `(+${options[p].price})` : '';
					liRender += `<input type="radio"  class="option-checkbox" id="checkbox${productID}" name='${key}' value="${options[p].product_option_id}"  onchange="changePrice(${options[p].price},'Checkbox','${options[p].label}',${productID},null,'${key}')" >
                    <span class="checkmark"></span>
                  </label>
                </div>`;
				}
			}
			liRender += `</div>`;
		}

		//if radio
		if (title[0] == 'Radio') {
			localStorage.removeItem('Radio');

			liRender += `<div class="row mt-3">`;
			for (p = 0; p < options.length; p++) {
				if (options[p].label.length == 1 || options[p].label.length == 2) {
					liRender += `<div class="col-md-1 col-1 col-sm-1  col-lg-1 mx-2">
                  <label class="check-label">
                    <input type="radio" class="option-radio" name='${key}' value="${options[p].product_option_id}"  onchange="changePrice(${options[p].price},'Radio','${options[p].label}',${productID},null,'${key}')" >
                    <span class="checkmark-round">${options[p].label}</span>
                  </label>
                </div>`;
				}
				else {
					liRender += `<div class="col-md-4 col-sm-4 col-4 col-lg-4 mx-2">
                  <label class="check-label">${options[p].label} `;
					liRender += options[p].price > 0 ? `(+${options[p].price})` : '';
					liRender += `<input type="radio" class="option-radio" id="radio${productID}" name='${key}' value="${options[p].product_option_id}"  onchange="changePrice(${options[p].price},'Radio','${options[p].label}',${productID},null,'${key}')" >
                    <span class="checkmark"></span>
                  </label>
                </div>`;
				}
			}
			liRender += `</div>`;
		}

		//if select
		if (title[0] == 'Select') {
			localStorage.removeItem('Select');

			liRender += `  <select name="selectoption" id="select${productID}" class="form-control size_id" >
                  <option value="">Select Size</option>`;
			for (p = 0; p < options.length; p++) {
				liRender += `<option value="${options[p].product_option_id}">${options[p].label}`;
				liRender += options[p].price > 0 ? `(+${options[p].price})` : '';
				liRender += ` </option>`
			}

			liRender += `</select>`;
		}

		//if Color
		if (title[0] == 'Color') {
			localStorage.removeItem('Color');
			liRender += `<div class="row my-1">`;
			for (p = 0; p < options.length; p++) {
				liRender += `<div class="col-md-1 col-1 col-sm-1 mx-1  col-lg-1">
                <label class="check-label">`;
				liRender += `<input type="radio" id="color${productID}" name="optionColor" value="${options[p].product_option_id}"  onchange="changePrice(${options[p].price},'Color','',${productID},this,'aa')" >
                  <span class="checkmark-round color-checkmark" style="background:${options[p].color_code}"></span>
                </label>
              </div>`;
			}
			liRender += `</div>`;
		}

		liRender += `</div> 						</div> 				</li> 		`
	}

	//set price
	liRender += `<div class="price-wrap">
               <input type="hidden" id="originalPrice" name="orignalPrice" value="${special > 0 ? special : price}">
               <div class="price">Price: <span id="priceproduct${productID}">${currency}${special > 0 ? special : price}</span>`;
	if (special > 0) {
		liRender += `<span class="originalPrice mx-2" style="font-size:16px;">${currency}${price}</span>`;
	}
	liRender += `	 </div></div>`

	liRender += `	<div class="quantity-wrap">
              <div class="quantitybox d-flex justify-content-center align-items-center">
                <div class="value-button decrease" onclick="decreaseValue($(this))" value="Decrease Value">
                  <i class="fas fa-sharp fa-regular fa-minus"></i>
                </div>
                  <div class="quantity ">
                      <label class="screen-reader-text" >Sponge Float dense sponge 40mm with long edge quantity</label>
                      <input type="number" class="input-text qty text" step="1" min="1" max="100" name="quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric" />
                  </div>
                  <div class="value-button increase"  onclick="increaseValue($(this))" value="Increase Value">
                    <i class="fas fa-sharp fa-regular fa-plus"></i>
                  </div>
              </div>
              <input type="hidden" name="productID" value="${productData.product.id}">
              <button  class="add-to-cart">Add to Cart  </button>
			  <button  class="add-to-cart buy-now">Buy Now  </button>

          </div>`;

	$('.product-modal-ul').append(liRender);

	$('#productDetailsModal').modal('show');
}

//on Price Change
function changePrice(price, type, label, productID = 0, that, key) {
	let currency = document.getElementsByName('currency')[0].content;
	let newPrice = 0;
	if (productID == 0) {
		newPrice = $('#priceproduct').text().replace(/^\D|,+/g, '');
	}
	else {
		newPrice = $('#priceproduct' + productID).text().replace(/^\D|,+/g, '');
	}
	newPrice = parseFloat(newPrice);

	if (that) {
		$('.color-checkmark').empty();
		$(that).siblings('.color-checkmark').html('<i class="fas fa-check" style="color:white"></i>')
	}

	if (type != "Color") {
		$('.optionSelected' + key).text(label);
	}

	if (productID != 0) {
		newPrice = $('#priceproduct' + productID).text().replace(/^\D|,+/g, '');
		newPrice = parseFloat(newPrice);
	}

	if (price > 0) {
		newPrice += parseFloat(price)
	}


	let getType = localStorage.getItem(key);
	if (getType > 0) {
		newPrice -= parseFloat(getType)
	}

	localStorage.setItem(key, price);
	if (productID != 0) {
		$('#priceproduct' + productID).text(currency + '' + newPrice.toFixed(2))
	}
	else {
		$('#priceproduct').text(currency + '' + newPrice.toFixed(2))
	}
}

/*-----QUANTITY BOX-----*/
/*Increment input*/
function increaseValue(ele) {
	var value = ele.parent().find('input[type="number"]').val();
	// var value = parseInt(inputele.value, 10);
	value = isNaN(value) ? 0 : value;
	value++;

	ele.parent().find('input[type="number"]').val(value);
	if (value == 0) {
		ele.parents('.roomlistbox').removeClass('selectedinput');
		if ($('.quantitybox').length > 0) {
			ele.parents('.quantitybox').parent().prev().parent().removeClass('selectedinput');
		}
	} else {
		ele.parents('.roomlistbox').addClass('selectedinput');
		if ($('.quantitybox').length > 0) {
			ele.parents('.quantitybox').parent().prev().parent().addClass('selectedinput');
		}
	}
}

function decreaseValue(ele) {
	var value = ele.parent().find('input[type="number"]').val();
	//    var value = parseInt(inputele.value, 10);
	value = isNaN(value) ? 0 : value;
	value < 1 ? value = 1 : '';
	value--;
	ele.parent().find('input[type="number"]').val(value);
	if (value == 0) {
		ele.parents('.roomlistbox').removeClass('selectedinput');
		if ($('.quantitybox').length > 0) {
			ele.parents('.quantitybox').parent().prev().parent().removeClass('selectedinput');
		}
	} else {
		ele.parents('.roomlistbox').addClass('selectedinput');
		if ($('.quantitybox').length > 0) {
			ele.parents('.quantitybox').parent().prev().parent().addClass('selectedinput');
		}
	}
}

/*-----ADD TO WISHLIST-----*/
function addToWish(that, productID, isProductDetail = false) {

	event.preventDefault();
	let isLoggedin = document.getElementsByName('isLogin')[0].content;

	if (!isLoggedin) {
		new RetroNotify({
			style: 'white',
			animate: 'slideTopRight',
			contentHeader: '<i class="fa fa-info"></i> Failed',
			contentText: "Login Required",
			closeDelay: 2500
		});

	}
	else {

		let url = document.getElementsByName('baseURL')[0].content;
		let token = document.getElementsByName('csrf-token')[0].content;
		let assetURL = document.getElementsByName('frontendAssetURL')[0].content;
		let locale = document.getElementsByName('direction')[0].content;


		url = url + '/add-to-wishlist';

		$.ajax({
			url: url,
			type: 'post',
			data: { '_token': token, 'product_id': productID },
			dataType: 'json',
			success: function (response) {
				if (response.status == 1) {
					$('.wishlist-count').text(response.wishlistData.length)
					new RetroNotify({
						style: 'green',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-check"></i> Success',
						contentText: response.message,
						closeDelay: 2500
					});
					if (response.add == 1) {
						if (isProductDetail) {
							$(that).empty();
							if (locale == 1) {
								$(that).append('<i class="fa fa-heart" style="margin-left:10px;"></i>');
								$(that).append(' Wishlist');
							}
							else {
								$(that).append('<i class="fa fa-heart" style="margin-right:10px;" ></i>');
								$(that).append(' Wishlist');
							}
						}
						else {
							$(that).closest('div').addClass('fill-wishlist')
							$(that).find('img').remove();
							$(that).append('<i class="fas fa-heart"></i>');
						}
					}
					else {
						if (isProductDetail) {
							$(that).empty();
							if (locale == 1) {
								$(that).append('<i class="fa fa-heart-o" style="margin-left:10px;"></i>');
								$(that).append(' Wishlist');
							}
							else {
								$(that).append('<i class="fa fa-heart-o" style="margin-right:10px;" ></i>');
								$(that).append(' Wishlist');
							}
						}
						else {
							$(that).closest('div').removeClass('fill-wishlist')
							$(that).find('i').remove();
							$(that).append('<img src="' + assetURL + '/images/little-heart.png" alt="" title="" class="" />');
						}
					}
				}
				else {
					new RetroNotify({
						style: 'white',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-info"></i> Failed',
						contentText: response.message,
						closeDelay: 2500
					});

				}
			}
		});
	}



}


/*-----UPDATE CART-----*/
function updateQty(that, cartID) {
	let qty = $(that).parent().find('input[type="number"]').val();
	let isLoggedin = document.getElementsByName('isLogin')[0].content;
	let currency = document.getElementsByName('currency')[0].content;

	if (qty > 0) {
		let url = document.getElementsByName('baseURL')[0].content;
		let token = document.getElementsByName('csrf-token')[0].content;
		url = url + '/update-quantity';
		$.ajax({
			url: url,
			type: 'post',
			data: { '_token': token, 'cart_id': cartID, 'quantity': qty },
			dataType: 'json',
			success: function (response) {
				if (response.status == 1) {
					new RetroNotify({
						style: 'green',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-check"></i> Success',
						contentText: response.message,
						closeDelay: 2500
					});
					let unitPrice = $('.unitprice' + cartID).text().replace(/^\D|,+/g, '');
					unitPrice = parseFloat(unitPrice);
					$('.totalPrice' + cartID).text(currency + '' + unitPrice * qty);
					$('.subTotal').text(currency + '' + response.subTotal);
					$('.grandTotal').text(currency + '' + response.grandTotal);
					$('.taxAmt').text(currency + '' + response.taxes.taxAmount.toFixed(2));
					$('.discountAmt').text(response.discount ? currency + '' + response.discount : 0);
					if (response.discount > 0) {

						$('.discount-message').removeClass('d-none')
						let html = `You Save ${response.discount}`
						if (response.discountType == 1) {
							html += ` Discount(${response.discountPer}%)`
						}

						$('.discount-message').html(html);
					}
					else {
						$('.discount-message').addClass('d-none')
					}

					$('.basket-count').text(response.cartCount);
				}
				else {

					new RetroNotify({
						style: 'white',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-info"></i> Failed',
						contentText: response.message,
						closeDelay: 2500
					});

				}
			}
		});
	}
	else {
		new RetroNotify({
			style: 'white',
			animate: 'slideTopRight',
			contentHeader: '<i class="fa fa-info"></i> Failed',
			contentText: 'Quantity must be Greater then 0',
			closeDelay: 2500
		});
	}

}


/*-----DELETE CART-----*/
function deleteCart(that, cartID) {
	Swal.fire({
		title: 'Are you sure?',
		text: 'Do you want to remove this item from cart?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: ' #626ABB',
		confirmButtonText: 'Yes, remove it!'
	}).then((result) => {
		if (result.isConfirmed) {
			let url = document.getElementsByName('baseURL')[0].content;
			let token = document.getElementsByName('csrf-token')[0].content;
			url = url + '/remove-item';
			$.ajax({
				url: url,
				type: 'post',
				data: { '_token': token, 'cart_id': cartID },
				dataType: 'json',
				success: function (response) {
					if (response.status == 1) {
						new RetroNotify({
							style: 'green',
							animate: 'slideTopRight',
							contentHeader: '<i class="fa fa-check"></i> Success',
							contentText: response.message,
							closeDelay: 2500
						});


						// let unitPrice = parseFloat($('.unitprice'+cartID).text());
						// $('.totalPrice'+cartID).text(unitPrice * qty);
						$('.subTotal').text(response.subTotal);
						$('.grandTotal').text(response.grandTotal);
						$('.taxAmt').text(response.taxes[1]);
						$('.discountAmt').text(response.discount ? response.discount : 0);
						$('.cart' + cartID).remove();
						if (response.cartCount == 0) {
							$('.shopping-wrapper').empty();
							$('.empty-cart').removeClass('d-none');
						}
						$('.basket-count').text(response.cartCount);
					}
					else {
						new RetroNotify({
							style: 'white',
							animate: 'slideTopRight',
							contentHeader: '<i class="fa fa-info"></i> Failed',
							contentText: response.message,
							closeDelay: 2500
						});

					}
				}
			});
		}
	})

}


/*-----Apply Coupon-----*/
function applyCoupon() {
	$('#coupon_input').val();
	if ($('#coupon_input').val()) {
		let url = document.getElementsByName('baseURL')[0].content;
		let token = document.getElementsByName('csrf-token')[0].content;
		let currency = document.getElementsByName('currency')[0].content;

		url = url + '/apply-coupon';
		$.ajax({
			url: url,
			type: 'post',
			data: { '_token': token, 'couponCode': $('#coupon_input').val() },
			dataType: 'json',
			success: function (response) {
				if (response.status == 1) {
					new RetroNotify({
						style: 'green',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-check"></i> Success',
						contentText: response.message,
						closeDelay: 2500
					});


					$('.grandTotal').text(currency + '' + response.grandTotal);
					$('.discountAmt').text(currency + '' + response.discount.discountAmt);
					$('.discount-message').removeClass('d-none')
					let html = `You Save ${currency}${response.discount.discountAmt}`
					if (response.discountType == 1) {
						html += ` Discount(${response.discountPer}%)`
					}
					$('.discount-message').html(html)
				}
				else if (response.status == 0) {
					new RetroNotify({
						style: 'white',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-info"></i> Failed',
						contentText: response.message,
						closeDelay: 2500
					});

					$('.discountAmt').text('0');
					$('.discount-message').addClass('d-none')
					$('.grandTotal').text(currency + '' + response.grandTotal);
				}
				else {
					new RetroNotify({
						style: 'red',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-close"></i> Failed',
						contentText: response.message,
						closeDelay: 2500
					});


					$('.discount-message').addClass('d-none')
				}
			}
		});
	}
	else {
		new RetroNotify({
			style: 'white',
			animate: 'slideTopRight',
			contentHeader: '<i class="fa fa-info"></i> Failed',
			contentText: 'Coupon Code Required!',
			closeDelay: 2500
		});

	}
}

function addAddress(countries, type) {
	(async () => {

		localStorage.setItem('countries', countries);

		let isLoggedin = document.getElementsByName('isLogin')[0].content;


		let addressHTML = `<input id="name" placeholder="Enter name" class="form-control">`;
		if (!isLoggedin) {
			addressHTML += `<input id="useremail" type="email" placeholder="Enter email address" class="my-3 form-control">
			<input id="usermobile" type="number" placeholder="Enter mobile number" class="my-3  form-control">
			`;
		}
		addressHTML += `<textarea class="form-control mt-3 mb-3" placeholder="Enter your address" id="address_1" ></textarea>
		 <textarea class="form-control mt-3 mb-3" placeholder="Enter your address 2 (optional)" id="address_2" ></textarea>
		 <select class="form-control mt-3 mb-3" id="country_id" onchange="getStates(this.value)">
			 <option>Select Country</option>`
		let countryArr = JSON.parse(countries);
		for (let c = 0; c < countryArr.length; c++) {
			addressHTML += `<option value='${countryArr[c].id}'>${countryArr[c].name}</option>`;
		}
		addressHTML += `</select>
			 <select class="form-control mt-3 mb-3" id="add_address_state" >
		 	 <option value="">Select State</option>`
		addressHTML += `</select>
		 <input id="city" placeholder="Enter city" class="form-control">
		 <input id="postcode" placeholder="Enter postcode" class="form-control mt-3 mb-3">
		`

		const { value: formValues } = await Swal.fire({
			title: 'Add Address',
			html: addressHTML,
			focusConfirm: false,
			confirmButtonText: "Add Address",
			preConfirm: () => {
				let error = false;
				if (!document.getElementById('name').value) {
					error = true;
					new RetroNotify({
						style: 'white',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-info"></i> Failed',
						contentText: 'Name is required',
						closeDelay: 2500
					});

				}
				if (!isLoggedin && !document.getElementById('useremail').value) {
					error = true;
					new RetroNotify({
						style: 'white',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-info"></i> Failed',
						contentText: 'Email is required',
						closeDelay: 2500
					});

				}
				if (!isLoggedin && !document.getElementById('usermobile').value) {
					error = true;
					new RetroNotify({
						style: 'white',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-info"></i> Failed',
						contentText: 'Mobile Number is required',
						closeDelay: 2500
					});

				}
				if (!document.getElementById('address_1').value) {
					error = true;
					new RetroNotify({
						style: 'white',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-info"></i> Failed',
						contentText: 'Address is required',
						closeDelay: 2500
					});

				}
				if (!document.getElementById('country_id').value) {
					error = true;
					new RetroNotify({
						style: 'white',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-info"></i> Failed',
						contentText: 'Country is required',
						closeDelay: 2500
					});
				}
				if (!document.getElementById('add_address_state').value) {
					error = true;
					new RetroNotify({
						style: 'white',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-info"></i> Failed',
						contentText: 'State is required',
						closeDelay: 2500
					});
				}
				if (!document.getElementById('city').value) {
					error = true;
					new RetroNotify({
						style: 'white',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-info"></i> Failed',
						contentText: 'City is required',
						closeDelay: 2500
					});

				}
				if (!document.getElementById('postcode').value) {
					error = true;
					new RetroNotify({
						style: 'white',
						animate: 'slideTopRight',
						contentHeader: '<i class="fa fa-info"></i> Failed',
						contentText: 'Postcode is required',
						closeDelay: 2500
					});


				}

				if (error == false) {
					return [
						document.getElementById('name').value,
						document.getElementById('address_1').value,
						document.getElementById('address_2').value,
						document.getElementById('country_id').value,
						document.getElementById('add_address_state').value,
						document.getElementById('city').value,
						document.getElementById('postcode').value,
						document.getElementById('useremail') ? document.getElementById('useremail').value : '',
						document.getElementById('usermobile') ? document.getElementById('usermobile').value : ''
					]
				}

			}
		})

		if (formValues) {

			let url = document.getElementsByName('baseURL')[0].content;
			let token = document.getElementsByName('csrf-token')[0].content;
			url = url + '/add-address';
			$.ajax({
				url: url,
				type: 'post',
				data: { '_token': token, 'type': type, 'name': formValues[0], 'address_1': formValues[1], 'address_2': formValues[2], 'country_id': formValues[3], 'state_id': formValues[4], 'city': formValues[5], 'postcode': formValues[6], 'email': formValues[7], 'mobile': formValues[8] },
				dataType: 'json',
				success: function (response) {
					if (response.status == 1) {
						new RetroNotify({
							style: 'green',
							animate: 'slideTopRight',
							contentHeader: '<i class="fa fa-check"></i> Success',
							contentText: response.message,
							closeDelay: 2500
						});



						let renderHTML = `<div class="col-md-6 col-sm-12 col-xl-6 mt-3 mb-3 ">
				                <div class="address-box">
				                  <a class="edit-add" onclick="updateAddress(${response.addresses.id})"><i class="fa fa-pencil" aria-hidden="true"></i></a>
				                  <p class='addressItem${response.addresses.id}'>${response.addresses.name}, ${response.addresses.address_1},  ${response.addresses.address_2}, ${response.addresses.city}, ${response.addresses.postcode}, ${response.addresses.country} </p>
				                  <div class="address-check">
				                    <label class="check-label">Delivery Address
				                      <input type="radio" name="selectedDeliveryAddress" value="${response.addresses.id}">
				                      <span class="checkmark"></span>
				                    </label>
				                  </div>
				                </div>
				              </div>`;
						$('.addressData .col-xl-6:first').before(renderHTML);
						window.location.reload();

					}
					else if (response.status == 0) {
						new RetroNotify({
							style: 'white',
							animate: 'slideTopRight',
							contentHeader: '<i class="fa fa-info"></i> Failed',
							contentText: response.message,
							closeDelay: 2500
						});

					}
					else {
						new RetroNotify({
							style: 'red',
							animate: 'slideTopRight',
							contentHeader: '<i class="fa fa-close"></i> Failed',
							contentText: response.message,
							closeDelay: 2500
						});

						$('.discount-message').addClass('d-none')
					}
				}
			});
		}

	})()
}

///UPDATE ADDRESS
function updateAddress(addressID, countries) {
	if (countries == undefined) {
		countires = localStorage.getItem('countries');
	}
	let url = document.getElementsByName('baseURL')[0].content;
	let token = document.getElementsByName('csrf-token')[0].content;
	let getAddressUrl = url + '/get-address';
	let updateAddressUrl = url + '/update-address';
	let addressHTML = '';
	//get address
	$.ajax({
		url: getAddressUrl,
		type: 'post',
		data: { '_token': token, 'id': addressID },
		dataType: 'json',
		success: function (responseAddress) {
			if (responseAddress.status == 1) {
				getStates(responseAddress.data.country_id, 'edit', responseAddress.data.state_id)
				addressHTML = `<input id="name" value="${responseAddress.data.name}" placeholder="Enter name" class="form-control">
							<textarea class="form-control mt-3 mb-3" placeholder="Enter your address" id="address_1" >${responseAddress.data.address_1}</textarea>
							<textarea class="form-control mt-3 mb-3" placeholder="Enter your address 2 (optional)" id="address_2" >${responseAddress.data.address_2}</textarea>
							<select class="form-control mt-3 mb-3" id="country_id" onchange="getStates(this.value,'edit')">
								<option>Select Country</option>`
				let countryArr = countries ? JSON.parse(countries) : JSON.parse(localStorage.getItem('countries'));
				let optionsHTML = '';
				for (let c = 0; c < countryArr.length; c++) {
					optionsHTML += '<option value=' + countryArr[c].id
					if (countryArr[c].id == responseAddress.data.country_id) {
						optionsHTML += ' selected';
					}
					optionsHTML += '>' + countryArr[c].name + '</option>';
				}
				addressHTML += optionsHTML;
				addressHTML += `</select>
								<select class="form-control mt-3 mb-3" id="edit_address_state" >
								<option value="">Select State</option>
								</select>
														<input id="city" value="${responseAddress.data.city}" placeholder="Enter city" class="form-control">
								 							<input id="postcode" value="${responseAddress.data.postcode}" placeholder="Enter postcode" class="form-control mt-3 mb-3">
`;



				//show modal and form
				(async () => {


					const { value: formValues } = await Swal.fire({
						title: 'Update Address',
						html: addressHTML,
						focusConfirm: false,
						confirmButtonText: "Update Address",
						preConfirm: () => {
							let error = false;
							if (!document.getElementById('name').value) {
								error = true;
								new RetroNotify({
									style: 'white',
									animate: 'slideTopRight',
									contentHeader: '<i class="fa fa-info"></i> Failed',
									contentText: 'Name is required',
									closeDelay: 2500
								});
							}
							if (!document.getElementById('address_1').value) {
								error = true;
								new RetroNotify({
									style: 'white',
									animate: 'slideTopRight',
									contentHeader: '<i class="fa fa-info"></i> Failed',
									contentText: 'Address is required',
									closeDelay: 2500
								});

							}
							if (!document.getElementById('country_id').value) {
								error = true;
								new RetroNotify({
									style: 'white',
									animate: 'slideTopRight',
									contentHeader: '<i class="fa fa-info"></i> Failed',
									contentText: 'Country is required',
									closeDelay: 2500
								});
							}
							if (!document.getElementById('edit_address_state').value) {
								error = true;
								new RetroNotify({
									style: 'white',
									animate: 'slideTopRight',
									contentHeader: '<i class="fa fa-info"></i> Failed',
									contentText: 'State is required',
									closeDelay: 2500
								});
							}
							if (!document.getElementById('city').value) {
								error = true;
								new RetroNotify({
									style: 'white',
									animate: 'slideTopRight',
									contentHeader: '<i class="fa fa-info"></i> Failed',
									contentText: 'City is required',
									closeDelay: 2500
								});

							}
							if (!document.getElementById('postcode').value) {
								error = true;
								new RetroNotify({
									style: 'white',
									animate: 'slideTopRight',
									contentHeader: '<i class="fa fa-info"></i> Failed',
									contentText: 'Postcode is required',
									closeDelay: 2500
								});

							}

							if (error == false) {
								return [
									document.getElementById('name').value,
									document.getElementById('address_1').value,
									document.getElementById('address_2').value,
									document.getElementById('country_id').value,
									document.getElementById('edit_address_state').value,
									document.getElementById('city').value,
									document.getElementById('postcode').value,
								]
							}

						}
					})

					if (formValues) {


						$.ajax({
							url: updateAddressUrl,
							type: 'post',
							data: { '_token': token, 'id': addressID, 'name': formValues[0], 'address_1': formValues[1], 'address_2': formValues[2], 'country_id': formValues[3], 'state_id': formValues[4], 'city': formValues[5], 'postcode': formValues[6] },
							dataType: 'json',
							success: function (response) {
								if (response.status == 1) {
									new RetroNotify({
										style: 'green',
										animate: 'slideTopRight',
										contentHeader: '<i class="fa fa-check"></i> Success',
										contentText: response.message,
										closeDelay: 2500
									});

									$('.addressItem' + addressID).empty();
									$('.addressItem' + addressID).html(`${response.address.name}, ${response.address.address_1},  ${response.address.address_2}, ${response.address.city}, ${response.address.postcode}, ${response.address.country}`)
								}
								else if (response.status == 0) {

									new RetroNotify({
										style: 'white',
										animate: 'slideTopRight',
										contentHeader: '<i class="fa fa-info"></i> Failed',
										contentText: response.message,
										closeDelay: 2500
									});



								}
								else {
									new RetroNotify({
										style: 'white',
										animate: 'slideTopRight',
										contentHeader: '<i class="fa fa-info"></i> Failed',
										contentText: response.message,
										closeDelay: 2500
									});
									$('.discount-message').addClass('d-none')
								}
							}
						});
					}

				})()


			}

		}
	});

}


///UPDATE ADDRESS
function deleteAddress(addressID) {
	let url = document.getElementsByName('baseURL')[0].content;
	let token = document.getElementsByName('csrf-token')[0].content;
	url = url + '/delete-addrss';

	Swal.fire({
		title: 'Are you sure?',
		text: 'Do you want to delete this address?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: ' #626ABB',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: url,
				type: 'post',
				data: { '_token': token, 'id': addressID },
				dataType: 'json',
				success: function (response) {
					if (response.status == 1) {
						new RetroNotify({
							style: 'green',
							animate: 'slideTopRight',
							contentHeader: '<i class="fa fa-check"></i> Success',
							contentText: response.message,
							closeDelay: 2500
						});


						$('.removeAdd' + addressID).remove();
					}
					else {
						new RetroNotify({
							style: 'white',
							animate: 'slideTopRight',
							contentHeader: '<i class="fa fa-info"></i> Failed',
							contentText: response.message,
							closeDelay: 2500
						});
					}
				}
			});
		}
	});
}

function selectShipping(shipping) {

	let url = document.getElementsByName('baseURL')[0].content;
	let token = document.getElementsByName('csrf-token')[0].content;
	url = url + '/select-shipping';
	$('.address-box').css({ "border": "1px solid rgb(18 21 51 / 20%)" })

	$.ajax({
		url: url,
		type: 'post',
		data: { '_token': token, 'id': shipping },
		dataType: 'json',
		success: function (response) {
			if (response.status == 1) {
				let currency = document.getElementsByName('currency')[0].content;

				$('.shipping-div-' + shipping).css({ "border": "1px solid #F24C62" })
				$('.shipping-rate').text(currency + '' + response.shipping.charges);
				$('.grand-total-price').text(currency + '' + response.grandTotal);

				$('.tax-box').empty();
				let taxHtml = '';
				let totalTaxAmount = 0;

				if (response.taxData.length > 0) {
					$.each(response.taxData, function (key, value) {
						taxHtml += `  <div class="total-box"><div class="summary-title">${value.taxName}</div>
												<div class="summary-price">${currency}${value.taxAmount}</div>
													</div>
												`;
						totalTaxAmount += parseFloat(value.taxAmount);
					});
				}

				$('.tax-box').append(taxHtml)
				let grandTotal = response.grandTotal;
				let totalAmount = parseFloat(grandTotal);
				let finaAmount = (totalAmount + totalTaxAmount).toFixed(2);
				$('.grand-total-price').text(currency + '' + finaAmount);

			}
			else {
				new RetroNotify({
					style: 'white',
					animate: 'slideTopRight',
					contentHeader: '<i class="fa fa-info"></i> Failed',
					contentText: response.message,
					closeDelay: 2500
				});
			}
		}
	});
}

//same as billing address
function sameasBilling(event) {
	if (event.is(':checked')) {
		$('.deliveryAdd').addClass('d-none');
		//calculate tax based on address shipping address
		let selectedAddress = $('input[name="billing_address_id"]:checked').val()
		if (selectedAddress > 0) {
			getTaxRates(selectedAddress)
		}
		else {
			$(event).prop('checked', false); // Unchecks it
			new RetroNotify({
				style: 'white',
				animate: 'slideTopRight',
				contentHeader: '<i class="fa fa-info"></i> Failed',
				contentText: 'Select Address First',
				closeDelay: 2500
			});
		}
	}
	else {
		$('.deliveryAdd').removeClass('d-none')
	}
}

//getStates
function getStates(id, type = null, selectedState = 0) {
	let url = document.getElementsByName('baseURL')[0].content;
	let token = document.getElementsByName('csrf-token')[0].content;
	$('#sameasBillingAddress').prop('checked', false); // Unchecks it
	$('.deliveryAdd').removeClass('d-none');

	url = url + '/get-states';
	$.ajax({
		url: url,
		type: 'post',
		data: { '_token': token, 'country_id': id },
		dataType: 'json',
		success: function (response) {
			$('#add_address_state').empty();
			$('#edit_address_state').empty();

			if (type == 'edit') {

				$.each(response.data, function (key, value) {
					let selectHTML = `<option value="${value.state_id}"`;
					if (value.state_id == selectedState) {
						selectHTML += `selected="true"`;
					}
					selectHTML += `>${value.name}</option>`
					$('#edit_address_state').append(selectHTML)
				});
			}
			else {
				$.each(response.data, function (key, value) {
					$('#add_address_state')
						.append($("<option></option>")
							.attr("value", value.state_id)
							.text(value.name));
				});
			}
		}
	});
}

function calculateTax(event) {
	if (event.is(':checked')) {
		getTaxRates($(event).val())
	}
}

function getTaxRates(address_id) {
	let url = document.getElementsByName('baseURL')[0].content;
	url = url + '/calculate-tax';
	let token = document.getElementsByName('csrf-token')[0].content;
	let currency = document.getElementsByName('currency')[0].content;

	$.ajax({
		url: url,
		type: 'post',
		data: { '_token': token, 'address_id': address_id },
		dataType: 'json',
		success: function (response) {
			$('.tax-box').empty();
			let taxHtml = '';
			let totalTaxAmount = 0;
			if (response.tax.length > 0) {
				$.each(response.tax, function (key, value) {
					taxHtml += `  <div class="total-box"><div class="summary-title">${value.taxName}</div>
										<div class="summary-price">${currency}${value.taxAmount}</div>
											</div>
										`;
					totalTaxAmount += parseFloat(value.taxAmount);
				});
			}

			$('.tax-box').append(taxHtml)
			let grandTotal = response.grandTotal;
			let totalAmount = parseFloat(grandTotal);
			let finaAmount = (totalAmount + totalTaxAmount).toFixed(2);
			$('.grand-total-price').text(currency + '' + finaAmount);
		}
	});
}
