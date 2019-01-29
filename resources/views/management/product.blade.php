@extends('layouts.master_admin')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="" style="margin: 0;font-size: 26px;">List User</h3>
                <div class="clearfix"></div>
                <a href="#add" class="btn btn-success" style="margin:10px 0px;" data-toggle="modal">Add new User</a>    
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="prod_table" class="display">
                    <thead>
                        <tr>
                            <th>Id.</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Sale Price</th>
                            <th>Category</th>
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
<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" id="prod_add" role="form" data-toggle="validator"enctype="multipart/form-data" data-url="{{route('prod.store')}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>            
                </div>
                <div class="modal-body">
                    <h2 style="text-align: center;">Product:</h2>
                    @csrf
                    <div id="user-error-add" style="text-align: center;">

                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-7">
                                <div id="form-step-0" role="form" data-toggle="validator">
                                    <div class="form-group">
                                        <label for="">Code</label>
                                        <input type="text" class="form-control" name="code" id="prod_add_code" placeholder="Enter Code" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Slug</label>
                                        <input name="slug" type="text" class="form-control" id="prod_add_slug" placeholder="Slug" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input name="name" type="text" class="form-control" id="prod_add_name" placeholder="Enter Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <input name="description" type="text" class="form-control" id="prod_add_description" placeholder="Enter Description" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Content</label>
                                        <textarea name="content" id="prod_add_content" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" class="form-control" id="prod_add_price" placeholder="Enter Price" required name='price'>
                                </div>
                                <div class="form-group">
                                    <label for="">Sale Price</label>
                                    <input type="text" class="form-control" id="prod_add_sale_price" placeholder="Enter Sale Price" name='sale_price'>
                                </div>
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="text" class="form-control" id="prod_add_quantity" placeholder="Enter Quantity" name='quantity'>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <br>
                                    <select class="category form-control" name="category"style="width: 100%; height: 100%;" id="prod_add_category">
                                        @foreach($categories as $cate)
                                        <option value="{{$cate->id}}"> {{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Size</label>
                                    <select class="sizes form-control" name="sizes[]"style="width: 100%; height: 100%;" multiple="multiple" id="prod_add_size">
                                        @foreach($sizes as $size)
                                        <option value="{{$size->id}}"> {{$size->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <select class="colors form-control" name="colors[]"style="width: 100%; height: 100%;" multiple="multiple" id="prod_add_color">
                                        @foreach($colors as $color)
                                        <option value="{{$color->id}}"> {{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action=""​ id="prod_form_edit" method="POST" role="form">
                {{ csrf_field() }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Product</h4>
                </div>
                <div class="modal-body">
                    <h2 style="text-align: center;">Product:</h2>
                    @csrf
                    <div id="user-error-edit" style="text-align: center;">

                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-7">
                                <div id="form-step-0" role="form" data-toggle="validator">
                                    <div class="form-group">
                                        <label for="">Code</label>
                                        <input type="text" class="form-control" name="code" id="prod_edit_code" placeholder="Enter Code" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Slug</label>
                                        <input name="slug" type="text" class="form-control" id="prod_edit_slug" placeholder="Slug" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input name="name" type="text" class="form-control" id="prod_edit_name" placeholder="Enter Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <input name="description" type="text" class="form-control" id="prod_edit_description" placeholder="Enter Description" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Content</label>
                                        <textarea name="prod_edit_content" id="prod_edit_content" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" class="form-control" id="prod_edit_price" placeholder="Enter Price" required name='price'>
                                </div>
                                <div class="form-group">
                                    <label for="">Sale Price</label>
                                    <input type="text" class="form-control" id="prod_edit_sale_price" placeholder="Enter Sale Price" name='sale_price'>
                                </div>
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="text" class="form-control" id="prod_edit_quantity" placeholder="Enter Quantity" name='quantity'>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <br>
                                    <select class="category form-control" name="category"style="width: 100%; height: 100%;" id="prod_edit_category">
                                        @foreach($categories as $cate)
                                        <option value="{{$cate->id}}"> {{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Size</label>
                                    <select class="sizes form-control" name="sizes[]"style="width: 100%; height: 100%;" multiple="multiple" id="prod_edit_size">
                                        @foreach($sizes as $size)
                                        <option value="{{$size->id}}"> {{$size->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <select class="colors form-control" name="colors[]"style="width: 100%; height: 100%;" multiple="multiple" id="prod_edit_color">
                                        @foreach($colors as $color)
                                        <option value="{{$color->id}}"> {{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(document).ready( function () {
        CKEDITOR.replace('prod_edit_content');
        // js select 2

        $('.category').select2({
            placeholder: "Select a category",
        });
        $('.sizes').select2({
            placeholder: "Select a size",
        });
        $('.colors').select2({
            placeholder: "Select a colors",
        });

        // het js select 2

        // datatable

        $('#prod_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('prod.getdata') }}",
            "columns":[
            { "data": "id" },
            { "data": "code" },
            { "data": "name" },
            { "data": "price" },
            { "data": "sale_price" },
            { "data": "category_id" },
            { "data": "action", orderable:false, searchable: false}
            ]
        });

        // het datatable


        // format number

        $('#prod_add_price, #prod_add_sale_price, #prod_add_quantity').maskNumber({
            integer: true,
            thousands: ',',
        });

        $('#prod_edit_price, #prod_edit_sale_price, #prod_edit_quantity').maskNumber({
            integer: true,
            thousands: ',',
        });
        
        // het format number

        // dropzone
        Dropzone.options.myDropzone= {
            url: '{{ url('admincp/uploadImg') }}',
        }
        //het dropzone

        // toslug
        function toSlug (title) {
            var slug;
            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            return slug;
        }

        $('#prod_add_name').keyup(function (argument) {
            var title = $('#prod_add_name').val();
            var slug = toSlug(title);
            $('#prod_add_slug').val(slug);
        });   

        $('#prod_edit_name').keyup(function (argument) {
            var title = $('#prod_edit_name').val();
            var slug = toSlug(title);
            $('#prod_edit_slug').val(slug);
        }); 
        // het toslug


        // add product

        $('#prod_add').submit(function(event) {
            event.preventDefault();
            var url=$(this).attr('data-url');
            console.log(url);
            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serializeArray(),
                success: function(response){
                 //    console.log(response);
                 //    if(typeof response.errors != 'undefined'){
                 //        var alert = "";
                 //        for(var i=0;i<response.errors.length;i++){
                 //         alert += '<div class="err alert alert-danger">'+response.errors[i]+'</div>';
                 //     }
                 //     $('#user-error-add').html(alert);
                 //     setTimeout(function () {
                 //        $('.err').remove();
                 //    },5000);
                 // }else{
                    console.log('thanhcong');
                    $('#prod_add_code').val('');
                    $('#prod_add_name').val('');
                    $('#prod_add_description').val('');
                    $('#prod_add_content').val('');
                    $('#prod_add_sale_price').val('');
                    $('#prod_add_price').val('');
                    $('#prod_add_quantity').val('');
                    $('#prod_add_category').val('');
                    $('#prod_add_color').val('');
                    $('#prod_add_size').val('');
                    $('#add').modal('hide');
                    toastr.success('them moi thanh cong');
                    $('#user_table').DataTable().ajax.reload();
                // }
            },
        });
        });

        // het add product

        // edit product
        $("#prod_table").on('click', '.btn-edit', function(e) {
            //mở modal edit lên
            $('#modal-edit').modal('show');
            e.preventDefault();
            var id = $(this).attr("data-id");
            console.log(id);
            $.ajax({
                url:"{{route('prod.edit')}}",
                method:'get',
                data:{id:id},
                dataType:'json',
                success: function (response) {
                    console.log(response);
                    // console.log([response.color].length);
                    console.log(response.category);
                    $('#prod_edit_code').val(response.code);
                    $('#prod_edit_slug').val(response.slug);
                    $('#prod_edit_name').val(response.name);
                    $('#prod_edit_description').val(response.description);
                    // $('#prod_edit_content').text(response.content);
                    $('#prod_edit_sale_price').val(response.sale_price);
                    $('#prod_edit_price').val(response.price);
                    $('#prod_edit_quantity').val(response.quantity);
                    // object to array
                    var color = $.map(response.color, function(value, index) {
                        return [value];
                    });
                    var size = $.map(response.size, function(value, index) {
                        return [value];
                    });
                    // var category = $.map(response.category, function(value, index) {
                    //     return [value];
                    // });
                    $('#prod_edit_category').val(response.category).trigger('change');
                    $("#prod_edit_color").val(color).trigger('change');
                    $("#prod_edit_size").val(size).trigger('change');
                    // CKEDITOR.replace( 'edit_content' );
                    // CKEDITOR.instances['edit_content'].on('change',function(){
                    //     CKEDITOR.instances['edit_content'].updateElement();
                    //     CKEDITOR.replace( 'edit_content' );
                    // });
                    CKEDITOR.instances['prod_edit_content'].setData(response.content);
                    $('#prod_form_edit').attr('data-url','{{ asset('admin/product/') }}/'+response.id)
                },
            })
        })

        // het edit product

        // update product

        $('#prod_form_edit').submit(function (e) {
            e.preventDefault();
            //lấy data-url của form edit
            var url=$(this).attr('data-url');
            $.ajax({
              //phương thức put
              type: 'put',
              url: url,
              //lấy dữ liệu trong form
              data: $(this).serializeArray(),
              success: function (response) {
               //  if(typeof response.errors != 'undefined'){
               //      var alert = "";
               //      for(var i=0;i<response.errors.length;i++){
               //         alert += '<div class="err alert alert-danger">'+response.errors[i]+'</div>';
               //     }
               //     $('#cate-error-edit').html(alert);
               //     setTimeout(function () {
               //      $('.err').remove();
               //  },5000);
               // }else{
                //thông báo update thành công
                toastr.success('edit success!')
                    //ẩn modal edit
                    $('#modal-edit').modal('hide');
                    $('#prod_edit_code').val('');
                    $('#prod_edit_name').val('');
                    $('#prod_edit_description').val('');
                    $('#prod_edit_content').val('');
                    $('#prod_edit_sale_price').val('');
                    $('#prod_edit_price').val('');
                    $('#prod_edit_quantity').val('');
                    $('#prod_edit_category').val('');
                    $('#prod_edit_color').val('');
                    $('#prod_edit_size').val('');
                    $('#cate_table').DataTable().ajax.reload();
                // }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //xử lý lỗi tại đây
            }
        })
        })
        // het update product

        // delete product

        $("#prod_table").on('click','.btn-delete',function(){
            var id = $(this).attr('data-id');
            if(confirm("Are you sure you want to Delete this data?"))
            {
                $.ajax({
                    url:"{{route('prod.destroy')}}",
                    mehtod:"get",
                    data:{id:id},
                    success:function(data)
                    {
                        toastr.success('Xoa thanh cong');
                        $('#prod_table').DataTable().ajax.reload();
                    }
                })
            }
            else
            {
                return false;
            }
        });

        // het delete product
    });

</script>
@endsection