@extends('layouts.master_admin')
@section('content')
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{$newOrder}}</h3>

				<p>New Orders</p>
			</div>
			<div class="icon">
				<i class="ion ion-bag"></i>
			</div>
			<a href="{{route('order.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>{{$totalOrder}}</h3>

				<p>Total Orders Complete In Month</p>
			</div>
			<div class="icon">
				<i class="ion ion-checkmark-circled"></i>
			</div>
			<a href="{{route('order.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>$ {{$totalDay}}</h3>

				<p>Total in Day</p>
			</div>
			<div class="icon">
				<i class="ion ion-cash"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3>$ {{$totalMonth}}</h3>

				<p>Total in Month</p>
			</div>
			<div class="icon">
				<i class="ion ion-cash"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
</div>
<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Top 5 Sản Phẩm bán chạy trong ngày</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
				<table class="table">
					<tr>
						<th style="width: 10px">#</th>
						<th>Product</th>
						<th>Size</th>
						<th>Color</th>
						<th>Price</th>
					</tr>
					<?php $i=1 ?>
					@foreach($top_sell_day as $key => $value)
					<tr>
						<td>{{$i}}</td>
						<td>{{$prod_name_day[$key]}}</td>
						<td>{{$size_name_day[$key]}}</td>
						<td>{{$color_name_day[$key]}}</td>
						<td>{{$prod_price_day[$key]}}</td>
					</tr>
					<?php $i++ ?>
					@endforeach
				</table>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->


		<!-- /.box -->
	</div>
	<div class="col-md-6">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Top 5 Sản Phẩm bán chạy trong tháng</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
				<table class="table">
					<tr>
						<th style="width: 10px">#</th>
						<th>Product</th>
						<th>Size</th>
						<th>Color</th>
						<th>Price</th>
					</tr>
					<?php $i=1 ?>
					@foreach($top_sell_month as $key => $value)
					<tr>
						<td>{{$i}}</td>
						<td>{{$prod_name_month[$key]}}</td>
						<td>{{$size_name_month[$key]}}</td>
						<td>{{$color_name_month[$key]}}</td>
						<td>{{$prod_price_month[$key]}}</td>
					</tr>
					<?php $i++ ?>
					@endforeach
				</table>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->


		<!-- /.box -->
	</div>
</div>
@endsection	