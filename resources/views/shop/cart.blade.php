@extends('layouts.master')
@section('header')
@include('layouts.header')
@endsection
@section('content')
<!-- breadcrumb -->
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			Shoping Cart
		</span>
	</div>
</div>


<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<div class="wrap-table-shopping-cart">
						<table class="table-shopping-cart" id="tr_cart">
							<tr class="table_head">
								<th class="column-1">Product</th>
								<th class="column-2"></th>
								<th class="column-3">Price</th>
								<th class="column-4">Quantity</th>
								<th class="column-5">Total</th>
							</tr>
							@if(Cart::content() !== null)
							@foreach(Cart::content() as $key => $row)
							<tr class="table_row">
								<td class="column-1">
									<div class="how-itemcart1" data-key={{$key}}>
										<img src="/images/{{$row->options->img}}" alt="IMG" >
									</div>
								</td>
								<td class="column-2">{{$row->name}} - {{$row->options->size}} - {{$row->options->color}}</td>
								<td class="column-3">$ {{$row->price}}</td>
								<td class="column-4">
									<div class="wrap-num-product flex-w m-l-auto m-r-0">
										<div class="btn-minus cl8 hov-btn3 trans-04 flex-c-m minus_prod" data-rowid="{{$key}}" data-id='{{$row->id}}' style="width: 45px" >
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product qty" type="number" name="num-product1" value="{{$row->qty}}" data-total="{{$row->options->totalQty}}" >

										<div class="btn-plus cl8 hov-btn3 trans-04 flex-c-m plus_prod" data-rowid="{{$key}}" data-id='{{$row->id}}' style="width: 45px">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>
								</td>
								<td class="column-5">$ {{$row->total}}</td>
							</tr>
							@endforeach
							@endif
								{{-- <tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="{{asset('shop_assets/images/item-cart-05.jpg')}}" alt="IMG">
										</div>
									</td>
									<td class="column-2">Lightweight Jacket</td>
									<td class="column-3">$ 16.00</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product2" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5">$ 16.00</td>
								</tr> --}}
							</table>
						</div>

						{{-- <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">

								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>

							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>
						</div> --}}
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						{{-- <div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2" id="subTotal">
									$ {{Cart::subtotal()}}
								</span>
							</div>
						</div> --}}

						{{-- <div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									There are no shipping methods available. Please double check your address, or contact us if you need any help.
								</p>
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Calculate Shipping
									</span>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="time">
											<option>Select a country...</option>
											<option>USA</option>
											<option>UK</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
									</div>
									
									<div class="flex-w">
										<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
											Update Totals
										</div>
									</div>

								</div>
							</div>
						</div> --}}

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2" id="subTotal">
									$ {{Cart::subtotal()}}
								</span>
							</div>
						</div>

						{{-- <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" > --}}
							<a href="{{route('shop.checkOut')}}" title="" style="color:white;" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Proceed to Checkout</a>
						{{-- </button> --}}
					</div>
				</div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$(document).ready(function() {
			@if(session()->has('error'))
				swal("Lỗi", "Xin vui lòng chọn sản phẩm trước khi thanh toán", "warning");
			@endif
			function delay(callback, ms) {
				var timer = 0;
				return function() {
					var context = this, args = arguments;
					clearTimeout(timer);
					timer = setTimeout(function () {
						callback.apply(context, args);
					}, ms || 0);
				};
			}
			$('#tr_cart').on('click', '.btn-minus', function(event) {
				// event.preventDefault();
				/* Act on the event */
				var numProduct = Number($(this).next().val());
				if(numProduct > 0) $(this).next().val(numProduct - 1);
				id = $(this).attr('data-id');
				rowId = $(this).attr('data-rowid');
				qty = $(this).next().val();
				// alert(qty);
				$.ajax({
					url: '/updateCart/'+ id ,
					type: 'post',
					async: false,
					cache: false,
					data: {
						id: id,
						rowId: rowId,
						qty: qty,
					},
					success: function (response) {
						var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
						$(this).on('click', function(){
							swal(nameProduct, "is added to cart !", "success");
						});
						$.ajax({
							url: '/infoCart',
							type: 'GET',
							cache: false,
							success: function(response){
								// console.log(response.output);
								$('#tr_cart').html('<tr class="table_head"><th class="column-1">Product</th><th class="column-2"></th><th class="column-3">Price</th><th class="column-4">Quantity</th><th class="column-5">Total</th></tr>');
								$('#tr_cart').append(response.output);
								$('#subTotal').html('$ ' + response.subTotal);
							}
						});
						$.ajax({
							url: '/menuCart',
							type: 'GET',
							cache: false,
							success: function(response){
								$('#menuCart').html(response.output);
							}
						});					
					},
				});
				
			});
			$('#tr_cart').on('click', '.btn-plus', function(event) {
				// event.preventDefault();
				/* Act on the event */
				var numProduct = Number($(this).prev().val());
				$(this).prev().val(numProduct + 1);

				var qty = $(this).prev().attr('data-total');
				if(numProduct >= qty){
					$(this).prev().val(qty);
				}
				id = $(this).attr('data-id');
				rowId = $(this).attr('data-rowId');
				qty = $(this).prev().val();
				// alert(qty);
				$.ajax({
					url: '/updateCart/'+id,
					type: 'post',
					async: false,
					cache: false,
					data: {
						id: id,
						rowId: rowId,
						qty: qty,
					},
					success: function (response) {
						var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
						$(this).on('click', function(){
							swal(nameProduct, "is added to cart !", "success");
						});
						$.ajax({
							url: '/infoCart',
							type: 'GET',
							cache: false,
							success: function(response){
								// console.log(response.output);
								$('#tr_cart').html('<tr class="table_head"><th class="column-1">Product</th><th class="column-2"></th><th class="column-3">Price</th><th class="column-4">Quantity</th><th class="column-5">Total</th></tr>');
								$('#tr_cart').append(response.output);
								$('#subTotal').html('$ ' + response.subTotal);

							}
						});
						$.ajax({
							url: '/menuCart',
							type: 'GET',
							cache: false,
							success: function(response){
								$('#menuCart').html(response.output);
							}
						});					
					},
				});
			});
			$('#tr_cart').on('click', '.how-itemcart1', function(event) {
				var key = $(this).attr('data-key');
				$.ajax({
					async:false,
					cache: false,
					url: '/deleteCart',
					type: 'post',
					data: {id: key},
					success:function(response){
						$.ajax({
							url: '/infoCart',
							type: 'GET',
							cache: false,
							success: function(response){
								$('#tr_cart').html('<tr class="table_head"><th class="column-1">Product</th><th class="column-2"></th><th class="column-3">Price</th><th class="column-4">Quantity</th><th class="column-5">Total</th></tr>');
								$('#tr_cart').append(response.output);
								$('#subTotal').html('$ ' + response.subTotal);
							}
						});
						$.ajax({
							url: '/menuCart',
							type: 'GET',
							cache: false,
							success: function(response){
								$('#menuCart').html(response.output);
							}
						});		
					}
				});			
			});
			$('#tr_cart').on('focusin', '.qty', function(event) {
				$(this).keyup(function (argument) {
					/* body... */
					var total = Number($(this).attr('data-total'));
					var val = Number($(this).val());
					if(val >= total){
						$(this).val(total);
						// console.log('ss');
					}
					if(Number($(this).val()) < 0){
						$(this).val(1);
					}
				})
			});
			$('#tr_cart').on('focusout', '.qty', function(event) {
				id = $(this).prev().attr('data-id');
				rowId = $(this).prev().attr('data-rowid');
				qty = $(this).val();
				// alert(qty);
				$.ajax({
					url: '/updateCart/'+ id ,
					type: 'post',
					async: false,
					cache: false,
					data: {
						id: id,
						rowId: rowId,
						qty: qty,
					},
					success: function (response) {
						var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
						$(this).on('click', function(){
							swal(nameProduct, "is added to cart !", "success");
						});
						$.ajax({
							url: '/infoCart',
							type: 'GET',
							async: true,
							cache: false,
							success: function(response){
								// console.log(response.output);
								$('#tr_cart').html('<tr class="table_head"><th class="column-1">Product</th><th class="column-2"></th><th class="column-3">Price</th><th class="column-4">Quantity</th><th class="column-5">Total</th></tr>');
								$('#tr_cart').append(response.output);
								$('#subTotal').html('$ ' + response.subTotal);
							}
						});
						$.ajax({
								url: '/menuCart',
								type: 'GET',
								cache: false,
								success: function(response){
									$('#menuCart').html(response.output);
								}
							});					
					},
				});
			});
		});
	</script>
	@endsection