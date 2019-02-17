@extends('layouts.master_admin')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="" style="margin: 0;font-size: 26px;">Order</h3>
                <div class="clearfix"></div>
                {{-- <a href="#add" class="btn btn-success" style="margin:10px 0px;" data-toggle="modal">Add new Product</a>  --}}   
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="ord_table" class="display">
                    <thead>
                        <tr>
                            <th>Id.</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Mobile</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#ord_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
               "url": "{{route('order.getOrder')}}",
               "type": "GET",
            },
            "columns":[
            { "data": "id" },
            { "data": "code" },
            { "data": "name" },
            { "data": "email" },
            { "data": "address" },
            { "data": "mobile" },
            { "data": "total" },
            { "data": "status", orderable:false, searchable: false},
            { "data": "action", orderable:false, searchable: false}
            ]
        });
        @if(session()->has('error'))
            swal("Lỗi", "Sản phẩm đã hết hàng", "error");
        @endif
    });

</script>
@endsection