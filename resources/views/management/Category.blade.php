@extends('layouts.master_admin')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="" style="margin: 0;font-size: 26px;">List Category</h3>
                <div class="clearfix"></div>
                <a href="#add" class="btn btn-success" style="margin:10px 0px;" data-toggle="modal">Add new Category</a>    
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="cate_table" class="display">
                    <thead>
                        <tr>
                            <th>Id.</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>#</th>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" class="" role="form" id="cate_add" data-url="{{route('cate.store')}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>            
                </div>
                <div class="modal-body">
                    <h2 style="text-align: center;">Category:</h2>
                    @csrf
                    <div id="cate-error-add" style="text-align: center;">

                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input name="name" type="text" class="form-control" id="cate_add_name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="">Slug</label>
                        <input name="slug" type="text" class="form-control" id="cate_add_slug" placeholder="Slug" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input name="description" type="text" class="form-control" id="cate_add_description" placeholder="Enter Description">
                    </div>
                    <div class="form-group">
                        <div class="">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-show">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Category Detail</h4>
            </div>
            <div class="modal-body" style="text-align: center;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Name</th>
                            <th style="text-align: center;">Slug</th>
                            <th style="text-align: center;">Description</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="cate_name"></td>
                            <td id="cate_slug"></td>
                            <td id="cate_description"></td>
                        </tr>
                    </tbody>
                </table>
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action=""​ id="cate_form_edit" method="POST" role="form">
                {{ csrf_field() }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                <div class="modal-body">
                    <div id="cate-error-edit">

                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input name="name" type="text" class="form-control" id="cate_edit_name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="">Slug</label>
                        <input name="slug" type="text" class="form-control" id="cate_edit_slug" placeholder="Enter Slug" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input name="description" type="text" class="form-control" id="cate_edit_description" placeholder="Enter Description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>

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
    // $('#table_id').DataTable();
    $(document).ready( function () {
     $('#cate_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('cate.getdata') }}",
        "columns":[
        { "data": "id" },
        { "data": "name" },
        { "data": "slug" },
        { "data": "description" },
        { "data": "action", orderable:false, searchable: false}
        ]
    });
     $('#cate_add').submit(function(event) {
        event.preventDefault();
        var url=$(this).attr('data-url');
        console.log(url);
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serializeArray(),
            success: function(response){
                console.log(response);
                if(typeof response.errors != 'undefined'){
                    var alert = "";
                    for(var i=0;i<response.errors.length;i++){
                       alert += '<div class="err alert alert-danger">'+response.errors[i]+'</div>';
                   }
                   $('#cate-error-add').html(alert);
                   setTimeout(function () {
                    $('.err').remove();
                },5000);
               }else{
                console.log('thanhcong');
                $('#cate_add_name').val('');
                $('#cate_add_slug').val('');
                $('#cate_add_description').val('');
                $('#add').modal('hide');
                toastr.success('them moi thanh cong');
                $('#cate_table').DataTable().ajax.reload();
            }
        },
    });
    });
     $("#cate_table").on('click','.btn-delete',function(){
        var id = $(this).attr('data-id');
        if(confirm("Are you sure you want to Delete this data?"))
        {
            $.ajax({
                url:"{{route('cate.destroy')}}",
                mehtod:"get",
                data:{id:id},
                success:function(data)
                {
                    toastr.success('Xoa thanh cong');
                    $('#cate_table').DataTable().ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
    });
     $("#cate_table").on('click', '.btn-show', function() {
        event.preventDefault();
        $('#modal-show').modal('show');
        /* Act on the event */
        var id = $(this).attr('data-id');
        $.ajax({
            url:"{{route('cate.show')}}",
            type: 'GET',
            data:{id:id},
            dataType:'json',
            success: function(response){
                console.log(response);
                $("#cate_name").html(response.name);
                $("#cate_slug").html(response.slug);
                $("#cate_description").html(response.description);
            },
        })
    });
        //bắt sự kiện click vào nút edit
        $("#cate_table").on('click', '.btn-edit', function(e) {
        //mở modal edit lên
        $('#modal-edit').modal('show');
        e.preventDefault();
        var id = $(this).attr("data-id");
        console.log(id);
        $.ajax({
            url:"{{route('cate.edit')}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success: function (response) {
                console.log(response);
                $('#cate_edit_name').val(response.name);
                $('#cate_edit_slug').val(response.slug),
                $('#cate_edit_description').val(response.description),
                $('#cate_form_edit').attr('data-url','{{ asset('admin/category/') }}/'+response.id)
            },
        })
    })
      //bắt sự kiện submit form edit
    $('#cate_form_edit').submit(function (e) {
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
            if(typeof response.errors != 'undefined'){
                var alert = "";
                for(var i=0;i<response.errors.length;i++){
                   alert += '<div class="err alert alert-danger">'+response.errors[i]+'</div>';
               }
               $('#cate-error-edit').html(alert);
               setTimeout(function () {
                $('.err').remove();
            },5000);
           }else{
            //thông báo update thành công
            toastr.success('edit success!')
                //ẩn modal edit
                $('#modal-edit').modal('hide');
                $('#cate_table').DataTable().ajax.reload();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //xử lý lỗi tại đây
        }
    })
    })
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
    $('#cate_add_name').keyup(function (argument) {
        var title = $('#cate_add_name').val();
        var slug = toSlug(title);
        $('#cate_add_slug').val(slug);
    });
    $('#cate_edit_name').keyup(function (argument) {
        var title = $('#cate_edit_name').val();
        var slug = toSlug(title);
        $('#cate_edit_slug').val(slug);
    });

  } );

</script>
@endsection