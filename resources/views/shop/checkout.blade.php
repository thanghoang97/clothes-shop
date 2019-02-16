@extends('layouts.master')
@section('header')
@include('layouts.header')
@endsection
@section('content')
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			Check Out
		</span>
	</div>
</div>
<form class="bg0 p-t-75 p-b-85" id="infoUser" method='post'>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<h3>Check Out</h3>
					<div class="form-group" id="error" style="padding-top: 15px;">

					</div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" value="">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" value="" >
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" name="address" value="" >
					</div>
					<div class="form-group">
						<label>Mobile</label>
						<input type="number" class="form-control" name="mobile" value="" >
					</div>
				</div>
			</div>
			<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30">
						Cart Totals
					</h4>

					<div class="flex-w flex-t bor12 p-b-13">
						<div style="width: 100%">
							{{-- <table class="table-shopping-cart" id="tr_cart"> --}}
								@foreach(Cart::content() as $key => $row)
								<div style="width: 100%;float: left;clear: both; padding-bottom: 10px">
									<div class="how-itemcart1" style="float: left;clear: both;" data-key={{$key}}>
										<img src="/images/{{$row->options->img}}" alt="IMG" >
									</div>
									<div>{{$row->name}} - {{$row->options->size}} - {{$row->options->color}} - x{{$row->qty}} </div>
								</div>
								@endforeach
							{{-- </table> --}}
						</div>
					</div>
					<div class="flex-w flex-t p-t-27 p-b-33">
						<div class="size-208">
							<span class="mtext-101 cl2">
								Total:
							</span>
						</div>

						<div class="size-209 p-t-1">
							<span class="mtext-110 cl2">
								$ {{Cart::subtotal()}}
							</span>
						</div>
					</div>
					<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" id="finish" type="submit">
						Finish
					</button>
				</div>
				

				
			</div>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
	$(document).ready(function() {
		$('#infoUser').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: '{{route('shop.infoUser')}}',
				type: 'POST',
				data: $(this).serializeArray(),
				success: function(response){
					if(typeof response.errors != 'undefined'){
						var alert = "";
						for(var i=0;i<response.errors.length;i++){
							alert += '<div class="err alert alert-danger">'+response.errors[i]+'</div>';
						}
						$('#error').html(alert);
					}else{
						window.location.href = '/';
					}
				}
			})		
		})	
	});
</script>
@endsection