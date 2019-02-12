@extends('layouts.master_admin')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="" style="margin: 0;font-size: 26px;">Product</h3>
                <div class="clearfix"></div>
                <a href="#add" class="btn btn-success" style="margin:10px 0px;" data-toggle="modal">Add new Product</a>    
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Category</label>
                                    <br>
                                    <select class="category form-control" name="category"style="width: 100%; height: 100%;" id="detail_add_category">
                                        @foreach($categories as $cate)
                                        <option value="{{$cate->id}}"> {{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" class="form-control" id="prod_add_price" placeholder="Enter Price" required name='price'>
                                </div>
                                <div class="form-group">
                                    <label for="">Sale Price</label>
                                    <input type="text" class="form-control" id="prod_add_sale_price" placeholder="Enter Sale Price" name='sale_price'>
                                </div>
                            </div>
                            <div class="col-md-8">
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
                            <div class="col-md-8">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Category</label>
                                    <br>
                                    <select class="category form-control" name="category"style="width: 100%; height: 100%;" id="detail_add_category">
                                        @foreach($categories as $cate)
                                        <option value="{{$cate->id}}"> {{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" class="form-control" id="prod_edit_price" placeholder="Enter Price" required name='price'>
                                </div>
                                <div class="form-group">
                                    <label for="">Sale Price</label>
                                    <input type="text" class="form-control" id="prod_edit_sale_price" placeholder="Enter Sale Price" name='sale_price'>
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
{{-- ========================= modal product detail ==================================== --}}
<div class="modal" id="modal-pdetail-add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <input type="hidden" class="prod_id">
            <input type="hidden" class="form_status">
            <input type="hidden" id="btn_id" value="1">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
            </div>
            <div class="modal-body">
                <h2 style="text-align: center;" id="detail_title"><span id='prod_name'></span></h2>
                <br>
                @csrf
                <div class="container-fluid">
                    {{-- Hiển thị thông tin và add quantity size color  --}}
                    <div class="row">
                        <div class="col-md-7">
                            <table id="prod_detail_table" class="">
                                <thead>
                                    <tr>
                                        <th>Quantity</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="col-md-5">
                            <form method="POST" id="pdetail_form_add" role="form" data-toggle="validator"enctype="multipart/form-data" data-url="{{route('detail.store')}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="text" class="form-control" id="detail_add_quantity" placeholder="Enter Quantity" name='quantity'>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Category</label>
                                    <br>
                                    <select class="category form-control" name="category"style="width: 100%; height: 100%;" id="detail_add_category">
                                        @foreach($categories as $cate)
                                        <option value="{{$cate->id}}"> {{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label>Size</label>
                                    <select class="sizes form-control" name="size" style="width: 100%; height: 100%;" id="detail_add_size">
                                        @foreach($sizes as $size)
                                        <option value="{{$size->id}}"> {{$size->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <select class="colors form-control" name="color" style="width: 100%; height: 100%;" id="detail_add_color">
                                        @foreach($colors as $color)
                                        <option value="{{$color->id}}"> {{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div id='button_detail'>
                                   <button type="submit" class="btn btn-primary">Submit</button> 
                               </div>  

                           </form> 
                       </div>
                   </div>
                   {{-- hết add --}}

                   {{-- Upload pic --}}
                   <div class="row">
                    <div class="col-sm-10 offset-sm-1">
                        <h2 class="page-heading">Upload your Images <span id="counter"></span></h2>
                        <form method="post" action="/admin/images-save"
                        enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                        {{ csrf_field() }}
                        <input type="hidden" class="prod_id" name="product_id">
                        <div class="dz-message">
                            <div class="col-xs-8">
                                <div class="message">
                                    <p>Drop files here or Click to Upload</p>
                                </div>
                            </div>
                        </div>
                        <div class="fallback">
                            <input type="file" name="file" multiple>
                        </div>
                    </form>
                </div>
                {{-- hết upload pic --}}
                {{--Dropzone Preview Template--}}
                <div id="preview" style="display: none;">

                    <div class="dz-preview dz-file-preview">
                        <div class="dz-image"><img data-dz-thumbnail /></div>

                        <div class="dz-details">
                            <div class="dz-size"><span data-dz-size></span></div>
                            <div class="dz-filename"><span data-dz-name></span></div>
                        </div>
                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                        <div class="dz-error-message"><span data-dz-errormessage></span></div>



                        <div class="dz-success-mark">

                            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                                <title>Check</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                    <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                                </g>
                            </svg>

                        </div>
                        <div class="dz-error-mark">

                            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                                <title>error</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                    <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                        <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
                {{--End of Dropzone Preview Template--}}
                <div class="row">
                    <div class="col-md-12">
                       <div class="table-responsive-sm">
                        <table class="table" id="img-table">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Original Filename</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="data_pic">
                                    {{-- @foreach($photos as $photo)
                                    <tr>
                                        <td><img src="/images/{{ $photo->resized_name }}"></td>
                                        <td>{{ $photo->filename }}</td>
                                        <td>{{ $photo->original_name }}</td>
                                        <td>{{ $photo->resized_name }}</td>
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
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
            ],
            // order: [[0, 'desc']]
        });
        
        $("#prod_table").on('click', '.btn-detail', function(e) {
            /* Act on the event */
            e.preventDefault();
            var id = $(this).attr("data-id");
            // $(this).attr("data-id");
            $('#btn_id').val(-1);
            var btn_id = $('#btn_id').val();
            $('.prod_id').val(id);
            $('.form_status').val('add');
            $('#detail_title').text('Detail Product: ');
            console.log('id' + id);
            $('#modal-pdetail-add').modal('show');
            // $('#my-dropzone').removeAllFiles(); 
            Dropzone.forElement('#my-dropzone').removeAllFiles(true) 
            $.ajax({
                url: '/admin/images-show/',
                type: 'get',
                data: {id:id},
                success: function(response){
                    // console.log(response);
                    $('#data_pic').html(response);
                }
            });
            $('#prod_detail_table').DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                ajax: {
                    url: '/admin/detail/getdetail/' + id + '/' + $('#btn_id').val(),
                },
                "columns":[
                { "data": "quantity" },
                { "data": "color_id" },
                { "data": "size_id" },
                { "data": "action", orderable:false, searchable: false}
                ]
            });
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
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
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
                    $('#add').modal('hide');
                    toastr.success('them moi thanh cong');
                    $('#prod_table').DataTable().ajax.reload();
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
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
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
                    $('#prod_edit_slug').val(response.name);
                    $('#prod_edit_name').val(response.name);
                    $('#prod_edit_description').val(response.description);
                    // $('#prod_edit_content').text(response.content);
                    $('#prod_edit_sale_price').val(response.sale_price);
                    $('#prod_edit_price').val(response.price);
                    $('#prod_edit_category').val(response.category).trigger('change');
                    CKEDITOR.instances['prod_edit_content'].setData(response.content);
                    $('#prod_form_edit').attr('data-url','{{ asset('admin/product/') }}/'+response.id)
                },
            })
        });

        // het edit product

        // update product

        $('#prod_form_edit').submit(function (e) {
            e.preventDefault();
            //lấy data-url của form edit
            var url=$(this).attr('data-url');
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            console.log($(this).serializeArray());
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
                    $('#prod_table').DataTable().ajax.reload();
                // }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //xử lý lỗi tại đây
            }
        })
        });
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
        
        // add detail product
        $('#pdetail_form_add').submit(function(event) {
            event.preventDefault();
            if($('.form_status').val() === 'add'){
                var url=$(this).attr('data-url');
                console.log(url);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        product_id: $('.prod_id').val(),
                        quantity: $('#detail_add_quantity').val(),
                        color: $('#detail_add_color').val(),
                        size: $('#detail_add_size').val(),
                    // $(this).serializeArray(),                 
                },
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
                    $('#detail_add_quantity').val('');
                    toastr.success('them moi thanh cong');
                    $('#prod_detail_table').DataTable().ajax.reload();
                // }
                
            },
        });
            }// hết if
            if($('.form_status').val() === 'edit'){
                var btn = $('#btn_id').val();
                $.ajax({
                    url: '/admin/detail/' + btn,
                    type: 'put',
                    data: {
                        product_id: $('.prod_id').val(),
                        quantity: $('#detail_add_quantity').val(),
                        color: $('#detail_add_color').val(),
                        size: $('#detail_add_size').val(),
                    // $(this).serializeArray(),                 
                },
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
                   var id = $('.prod_id').val();
                   console.log('thanhcong');
                   $('#detail_add_quantity').val('');
                   toastr.success('them moi thanh cong');
                   $('.form_status').val('add');
                   $('#button_detail').html('<button type="submit" class="btn btn-primary">Submit</button> ');
                   $('#detail_add_quantity').val('');
                   $("#detail_add_color").val(1).trigger('change');
                   $("#detail_add_size").val(1).trigger('change');
                   $('#prod_detail_table').DataTable().ajax.url( '/admin/detail/getdetail/' + id + '/-1').load();
                // }
                
            },
        });
            }
            
        });

        // het add detail product
        
        // delete detail
        $("#prod_detail_table").on('click','.detail-delete',function(){
            var id = $(this).attr('data-id');
            // console.log('delete' + id);
            if(confirm("Are you sure you want to Delete this data?"))
            {
                $.ajax({
                    url:"{{route('detail.destroy')}}",
                    mehtod:"get",
                    data:{id:id},
                    success:function(data)
                    {
                        toastr.success('Xoa thanh cong');
                        $('#prod_detail_table').DataTable().ajax.reload();

                    }
                })
            }
            else
            {
                return false;
            }
        });
        // hết delete detail
        
        // edit detail
        $("#prod_detail_table").on('click','.detail-edit',function(e){
            $('.form_status').val('edit');
            var id = $('.prod_id').val();
            var btn_id = $(this).attr('data-id');
            $('#btn_id').val(btn_id);
            console.log('newid' + id);
            $('#prod_detail_table').DataTable().ajax.url( '/admin/detail/getdetail/' + id + '/' + $('#btn_id').val() ).load();
            $('#button_detail').html('<button type="submit" class="btn btn-primary">Update</button><a class="btn btn-default" id="detail_cancel">Cancel</a>');
            e.preventDefault();
            var id = $(this).attr("data-id");
            console.log(id);
            $.ajax({
                url:"{{route('detail.edit')}}",
                method:'get',
                data:{id:btn_id},
                dataType:'json',
                success: function (response) {
                    console.log(response);
                    $('#detail_add_quantity').val(response.quantity);
                    $("#detail_add_color").val(response.color).trigger('change');
                    $("#detail_add_size").val(response.size).trigger('change');
                },
            });
        });
        // hết edit detail
        $("#button_detail").on('click','#detail_cancel',function(e){
            var id = $('.prod_id').val();
            $('.form_status').val('add');
            $('#button_detail').html('<button type="submit" class="btn btn-primary">Submit</button> ');
            $('#detail_add_quantity').val('');
            $("#detail_add_color").val(1).trigger('change');
            $("#detail_add_size").val(1).trigger('change');
            $('#prod_detail_table').DataTable().ajax.url( '/admin/detail/getdetail/' + id + '/-1').load();
        });
        
        // delete img
        $("#img-table").on('click','.img-delete',function(){
            var id = $(this).attr('data-id');
            if(confirm("Are you sure you want to Delete this data?"))
            {
                $.ajax({
                    url:"{{route('img.destroy')}}",
                    mehtod:"get",
                    data:{id:id},
                    success:function(data)
                    {
                        toastr.success('Xoa thanh cong');
                        // $('#prod_table').DataTable().ajax.reload();

                    }
                })
            }
            else
            {
                return false;
            }
        });
        // hết delete img
    });

</script>
@endsection