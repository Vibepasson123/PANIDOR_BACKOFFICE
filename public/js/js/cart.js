jQuery(document).ready(function ($) {

	var cartWrapper = $('.cd-cart-container');
	//product id - you don't need a counter in your real project but you can use your real product id
	var productId = 0;

	if (cartWrapper.length > 0) {
		//store jQuery objects
		var cartBody = cartWrapper.find('.body')
		var cartList = cartBody.find('ul').eq(0);
		var cartTotal = cartWrapper.find('.checkout').find('span');
		var cartTrigger = cartWrapper.children('.cd-cart-trigger');
		var cartCount = cartTrigger.children('.count')
		var addToCartBtn = $('.price_btn');
		var undo = cartWrapper.find('.undo');
		var undoTimeoutId;
		var CSRF_TOKEN = '{{csrf_token()}}';
		var Gdata=[];

		//add product to cart
		addToCartBtn.on('click', function (event) {
			event.preventDefault();
			addToCart($(this));
		});

		//open/close cart
		cartTrigger.on('click', function (event) {
			event.preventDefault();
			toggleCart();
		});

		//close cart when clicking on the .cd-cart-container::before (bg layer)
		cartWrapper.on('click', function (event) {
			if ($(event.target).is($(this))) toggleCart(true);
		});

		//delete an item from the cart
		cartList.on('click', '.delete-item', function (event) {
			event.preventDefault();
			removeProduct($(event.target).parents('.product'));
		});

		//update item quantity
		cartList.on('change', 'select', function (event) {
			quickUpdateCart();
		});

		//reinsert item deleted from the cart
		undo.on('click', 'a', function (event) {
			clearInterval(undoTimeoutId);
			event.preventDefault();
			cartList.find('.deleted').addClass('undo-deleted').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
				$(this).off('webkitAnimationEnd oanimationend msAnimationEnd animationend').removeClass('deleted undo-deleted').removeAttr('style');
				quickUpdateCart();
			});
			undo.removeClass('visible');
		});
	}

	function toggleCart(bool) {
		var cartIsOpen = (typeof bool === 'undefined') ? cartWrapper.hasClass('cart-open') : bool;

		if (cartIsOpen) {
			cartWrapper.removeClass('cart-open');
			//reset undo
			clearInterval(undoTimeoutId);
			undo.removeClass('visible');
			cartList.find('.deleted').remove();

			setTimeout(function () {
				cartBody.scrollTop(0);
				//check if cart empty to hide it
				if (Number(cartCount.find('li').eq(0).text()) == 0) cartWrapper.addClass('empty');
			}, 500);
		} else {
			cartWrapper.addClass('cart-open');
		}
	}
	

	function addToCart(element) {
		var cartIsEmpty = cartWrapper.hasClass('empty');
		//update cart product list
		var data = {
			'price_btn': element.data("price_btn"),
			'product_name': element.data("product_name"),
			'product_id':element.data("product_id")
		};
		
		
		$.ajax({
			headers: {
		  
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

				var: data = {
					'price': element.data("price_btn"),
					'product': element.data("product_name"),
					'product_id':element.data("product_id"),
				},
			
			  },
			
			  url: '/addcart',
			  type: "POST",
			  data: { price:element.data("price_btn"),product: element.data("product_name"),product_id:element.data("product_id") },
			   
		  },
		 

		  $.get('/getcart', function(data){
			
		
			/* console.log(data); */
			cartList.html('');
				$.each(data, function(i) {
			
				productId = productId + 1;
				var getproduts  = $('<li class="product">'+ data[i].id+'<div class="product-image"><a href="#0"><img src="/img/product-preview.png" alt="placeholder"></a></div><div class="product-details"><h3><a href="#0" value"+ data.price_btn +">'+data[i].name +'</a></h3><span class="price" data-rowid="">' + data[i].price + '.$</span><div class="actions"><a href="#0" class="delete-item">Delete</a><div class="quantity"><label for="cd-product-">Qty</label><span class="select"><select id="cd-product-' +data[i].price +'" name="quantity">'  +data[i].name+ '<option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select></span></div></div></div></li>');
				cartList.prepend(getproduts);
				updateCartTotal(data[i].price, true);
				updateCartCount(cartIsEmpty);
				cartWrapper.removeClass('empty');
			
					/* console.log(data); */
				})
	
		})
		  
		)

		
		addProduct(data)

		var data = {
			'product_id': element.data("product_id"),
			'price': element.data("price_btn"),
			'product': element.data("product_name"),
		
		};
	
	
	}

	function addProduct(data) {
	    productId = productId + 1;
		var productAdded = $('<li class="product">'+ data.product_id +'<div class="product-image"><a href="#0"><img src="/img/product-preview.png" alt="placeholder"></a></div><div class="product-details"><h3><a href="#0" value"+ data.price_btn +">' + data.product + '</a></h3><span class="price" data-rowid="">' + data.price + '.$</span><div class="actions"><a href="#0" class="delete-item">Delete</a><div class="quantity"><label for="cd-product-' + data.product + '">Qty</label><span class="select"><select id="cd-product-' + data.product + '" name="quantity"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select></span></div></div></div></li>');

		//cartList.prepend(productAdded);
	}
	

	function removeProduct(product) {
		clearInterval(undoTimeoutId);
		cartList.find('.deleted').remove();

		var topPosition = product.offset().top - cartBody.children('ul').offset().top,
			productQuantity = Number(product.find('.quantity').find('select').val()),
			productTotPrice_btn = Number(product.find('.price_btn').text().replace('$', '')) * productQuantity;

		product.css('top', topPosition + 'px').addClass('deleted');

		//update items count + total price
		updateCartTotal(productTotPrice_btn, false);
		updateCartCount(true, -productQuantity);
		undo.addClass('visible');

		//wait 8sec before completely remove the item
		undoTimeoutId = setTimeout(function () {
			undo.removeClass('visible');
			cartList.find('.deleted').remove();
		}, 8000);
	}

	function quickUpdateCart() {
		var quantity = 0;
		var price_btn = 0;

		cartList.children('li:not(.deleted)').each(function () {
			var singleQuantity = Number($(this).find('select').val());
			quantity = quantity + singleQuantity;
			productTotPrice_btn = price_btn + singleQuantity * Number($(this).find('.price_btn').text().replace('$', ''));
		});

		cartTotal.text(price_btn.toFixed(2));
		cartCount.find('li').eq(0).text(quantity);
		cartCount.find('li').eq(1).text(quantity + 1);
	}

	function updateCartCount(emptyCart, quantity) {
		if (typeof quantity === 'undefined') {
			var actual = Number(cartCount.find('li').eq(0).text()) + 1;
			var next = actual + 1;

			if (emptyCart) {
				cartCount.find('li').eq(0).text(actual);
				cartCount.find('li').eq(1).text(next);
			} else {
				cartCount.addClass('update-count');

				setTimeout(function () {
					cartCount.find('li').eq(0).text(actual);
				}, 150);

				setTimeout(function () {
					cartCount.removeClass('update-count');
				}, 200);

				setTimeout(function () {
					cartCount.find('li').eq(1).text(next);
				}, 230);
			}
		} else {
			var actual = Number(cartCount.find('li').eq(0).text()) + quantity;
			var next = actual + 1;

			cartCount.find('li').eq(0).text(actual);
			cartCount.find('li').eq(1).text(next);
		}
	}

	function updateCartTotal(price_btn, bool) {
		bool ? cartTotal.text((Number(cartTotal.text()) + Number(price_btn)).toFixed(2)) : cartTotal.text((Number(cartTotal.text()) - Number(price_btn)).toFixed(2));
	}
});