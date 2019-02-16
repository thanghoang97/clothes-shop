@extends('layouts.master_admin')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="" style="margin: 0;font-size: 26px;">Bill</h3>
                <div class="clearfix"></div>
                {{-- <a href="#add" class="btn btn-success" style="margin:10px 0px;" data-toggle="modal">Add new Product</a>  --}}   
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table-bordered table-striped" style="width: 100%; font-size: 18px">
                    <thead>
                        <tr>
                            <th style="padding: 15px 0px; text-align: center;">Order Code</th>
                            <th style="text-align: center;">Name</td>
                            <th style="text-align: center;">Color</th>
                            <th style="text-align: center;">Size</th>
                            <th style="text-align: center;">Quantity</th>
                            <th style="text-align: center;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orDetails as $detail)
                        <tr>
                            <td style="padding: 15px 0px;text-align: center;">{{$detail->order_code}}</td>
                            <td style="text-align: center;">
                                @foreach($products as $prod)
                                    @if($detail->product_id == $prod->id)
                                        {{$prod->name}}
                                    @endif 
                                @endforeach
                            </td>       
                            <td style="text-align: center;">
                                @foreach($tDetails as $td)
                                    @if($pDetails[$detail->product_detail_id] == $td->id )
                                        @foreach($colors as $color)
                                            @if($color->id == $td->color_id)
                                                {{$color->name}}
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                @foreach($tDetails as $td)
                                    @if($pDetails[$detail->product_detail_id] == $td->id )
                                        @foreach($sizes as $size)
                                            @if($size->id == $td->size_id)
                                                {{$size->name}}
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td style="text-align: center;">{{$detail->quantity}}</td>
                            <td style="text-align: center;">{{$detail->sub_total}}</td>
                        </tr>    
                        @endforeach
                    </tbody>
                </table>
                <div class="total" style="margin: 20px 0px; float: right; clear: both;">
                    <p style="font-size: 18px; font-weight: bold">Total: $ {{$order->total}}</p>
                </div>
                <div class="button" style="clear:both;float: right;display: inline-flex;">
                    @if($order->status == 0)
                        <form action="{{route('order.confirmCart',$order->code)}}" method="post" style="margin-right: 20px;">
                            <input class="btn btn-success" value="Xác nhận đơn hơn" type="submit" style="float:right;" />
                            @csrf
                        </form>
                        <form action="{{route('order.deleteCart',$order->code)}}" method="post">
                            <input class="btn btn-danger" value="Delete" type="submit" style="display: inline-block" />
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@endsection