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
                            <th>Slug</th>
                            <th>Price</th>
                            <th>Sale Price</th>
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
            <form method="POST" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="#" class="dropzone">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>            
                </div>
                <div class="modal-body">
                    <h2 style="text-align: center;">Product:</h2>
                    @csrf
                    <div id="user-error-add" style="text-align: center;">

                    </div>
                    <div id="smartwizard">
                        <ul>
                            <li><a href="#step-1">Step 1<br /><small>Product Information</small></a></li>
                            <li><a href="#step-2">Step 2<br /><small>Images</small></a></li>
                            <li><a href="#step-3">Step 3<br /><small>Confirm</small></a></li>
                        </ul>

                        <div>
                            <div id="step-1">
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
                                                    <label for="">Content</label>
                                                    <textarea name="content" id="prod_add_content" required></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Price</label>
                                                <input type="text" class="form-control" id="prod_add_price" placeholder="Enter Price" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Sale Price</label>
                                                <input type="text" class="form-control" id="prod_add_sale_price" placeholder="Enter Sale Price">
                                            </div>
                                            <div class="form-group">
                                                <label>Category</label>
                                                <br>
                                                <select class="category form-control" name="category"style="width: 100%; height: 100%;">
                                                    @foreach($categories as $cate)
                                                    <option value="{{$cate->id}}"> {{$cate->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Size</label>
                                                <select class="sizes form-control" name="sizes[]"style="width: 100%; height: 100%;" multiple="multiple">
                                                    @foreach($sizes as $size)
                                                    <option value="{{$size->id}}"> {{$size->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Color</label>
                                                <select class="colors form-control" name="colors[]"style="width: 100%; height: 100%;" multiple="multiple">
                                                    @foreach($colors as $color)
                                                    <option value="{{$color->id}}"> {{$color->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>   
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="step-2">
                                <h2>Your Name</h2>
                                <div id="form-step-1" role="form" data-toggle="validator">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        {{-- <div class="dropzone" id="my-dropzone" name="myDropzone">

                                        </div> --}}
                                        <input name="file" type="file" multiple />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-3">
                                <h2>Your Address</h2>
                                <div id="form-step-2" role="form" data-toggle="validator">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address" id="address" rows="3" placeholder="Write your address..." required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div> --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            { "data": "slug" },
            { "data": "price" },
            { "data": "sale_price" },
            { "data": "action", orderable:false, searchable: false}
            ]
        });

        // het datatable

        //step wizard

        var btnFinish = $('<button></button>').text('Finish')
        .addClass('btn btn-info btn-finish')
        .on('click', function(){
            if( !$(this).hasClass('disabled')){
                var elmForm = $("#myForm");
                if(elmForm){
                    elmForm.validator('validate');
                    var elmErr = elmForm.find('.has-error');
                    if(elmErr && elmErr.length > 0){
                        alert('Oops we still have error in the form');
                        return false;
                    }else{
                        alert('Great! we are ready to submit form');
                        elmForm.submit();
                        return false;
                    }
                }
            }
        });
        var btnCancel = $('<button></button>').text('Cancel')
        .addClass('btn btn-danger')
        .on('click', function(){
            $('#smartwizard').smartWizard("reset");
            $('#myForm').find("input, textarea").val("");
        });

        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'dots',
            showStepURLhash: false,
            transitionEffect:'fade',
            toolbarSettings: {toolbarPosition: 'bottom',
            toolbarButtonPosition: 'right',
            toolbarExtraButtons: [btnFinish, btnCancel],
        },
        anchorSettings: {
                                markDoneStep: true, // add done css
                                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                                removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
                                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                            }
                        });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            var elmForm = $("#form-step-" + stepNumber);
                // stepDirection === 'forward' :- this condition allows to do the form validation
                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                if(stepDirection === 'forward' && elmForm){
                    elmForm.validator('validate');
                    var elmErr = elmForm.children('.has-error');
                    if(elmErr && elmErr.length > 0){
                        // Form validation failed
                        return false;
                    }
                }
                return true;
            });

        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
                // Enable finish button only on last step
                if(stepNumber == 3){
                    $('.btn-finish').removeClass('disabled');
                }else{
                    $('.btn-finish').addClass('disabled');
                }
            });

            // het step wizard

            // format number

            $('#prod_add_price, #prod_add_sale_price').maskNumber({
                integer: true,
                thousands: ',',
            });
            
            // het format number


            Dropzone.options.myDropzone= {
                url: '{{ url('admincp/uploadImg') }}',
            }
        });

    </script>
    @endsection