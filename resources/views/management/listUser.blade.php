@extends('layouts.master_admin')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
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
				<table id="table_id" class="display">
					<thead>
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						{{-- {{ asset('/upload/20.jpg') }} --}}
						@foreach($users as $user)
						<tr>
							<td>{{$i++}}</td>
							<td>{{$user->name}}</td>
							<td>{{$user->username}}</td>
							<td>{{$user->email}}</td>
							<td>
								<a class="btn btn-warning btn-edit" data-url="{{ route('user.edit',$user->id) }}"​><i class="fa fa-pencil" aria-hidden="true"></i></a>
								<button type="button" class="btn btn-info btn-show" data-url="{{ route('user.show',$user->id) }}"​><i class="fa fa-eye" aria-hidden="true"></i></button>
								<button class="btn btn-danger btn-delete" data-id="{{$user->id}}" data-url="{{ route('user.destroy',$user->id) }}"​><i class="fa fa-times" aria-hidden="true"></i></button>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>#</th>
						</tr>
					</tfoot>
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
			<form method="POST" class="" role="form" id="user_add" data-url="{{ route('user.store') }}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>			
				</div>
				<div class="modal-body">
					<h2 style="text-align: center;">User:</h2>
					@csrf
					<div id="user-error-add" style="text-align: center;">
						
					</div>
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" type="text" class="form-control" id="user_add_name" placeholder="Enter Name">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="username" type="text" class="form-control" id="user_add_username" placeholder="Enter Username">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" type="email" class="form-control" id="user_add_email" placeholder="Enter Email">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="password" type="password" class="form-control" id="user_add_password" placeholder="Enter Password">
					</div>
					<div class="form-group">
						<label for="">Password-Confirm</label>
						<input name="password_confirmation" type="password" class="form-control" id="user_add_password_confirm" placeholder="Enter Password Confirm">
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
				<h4 class="modal-title">User Detail</h4>
			</div>
			<div class="modal-body" style="text-align: center;">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;">Name</th>
							<th style="text-align: center;">Username</th>
							<th style="text-align: center;">Email</th>	
						</tr>
					</thead>
					<tbody>
						<tr>
							<td id="user_name"></td>
							<td id="user_username"></td>
							<td id="user_email"></td>
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

			<form action=""​ id="user-form-edit" method="POST" role="form">
				{{ csrf_field() }}

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit User</h4>
				</div>
				<div class="modal-body">
					<div id="user-error-edit">
						
					</div>
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" type="text" class="form-control" id="user_edit_name" placeholder="Enter Name">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="username" type="text" class="form-control" id="user_edit_username" placeholder="Enter Username">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" type="email" class="form-control" id="user_edit_email" placeholder="Enter Email">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="password" type="password" class="form-control" id="user_edit_password" placeholder="Enter Password">
					</div>
					<div class="form-group">
						<label for="">Password-Confirm</label>
						<input name="password_confirmation" type="password" class="form-control" id="user_edit_password_confirm" placeholder="Enter Password Confirm">
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
		$('#table_id').DataTable();
		$('#user_add').submit(function(event) {
			event.preventDefault();
			var url=$(this).attr('data-url');
			console.log(url);
			$.ajax({
				url: url,
				type: 'POST',
				data: {
					_token: $('input[name="_token"]').val(),
					name: $('#user_add_name').val(),
					username: $('#user_add_username').val(),
					email: $('#user_add_email').val(),
					password: $('#user_add_password').val(),
					password_confirmation: $('#user_add_password_confirm').val()	
				},
				success: function(response){
					console.log(response);
					if(typeof response.errors != 'undefined'){
						var alert = "";
						for(var i=0;i<response.errors.length;i++){
							 alert += '<div class="err alert alert-danger">'+response.errors[i]+'</div>';
						}
						$('#user-error-add').html(alert);
						setTimeout(function () {
							$('.err').remove();
               			},5000);

					}else{
						$('#user_name').val('');
						$('#user_username').val(''),
						$('#user_email').val(''),
						$('#user_add_password').val(''),
						$('#user_add_password_confirm').val('')	
						$('#add').modal('hide');
						toastr.success('them moi thanh cong');
						setTimeout(function () {
							window.location.href="{{ route('user.index') }}";
						},800);
					}
				},
			});
		});
		$("#table_id").on('click','.btn-delete',function(){
			var url = $(this).attr('data-url');
			console.log(url);
			if(confirm("Are you sure ?")){
				$.ajax({
					url: url,
					type: 'delete',
					success: function (response) {
					//thông báo xoá thành công bằng toastr
					console.log('test xoa');
					toastr.warning('delete success!');
					setTimeout(function () {
                 	window.location.href="{{ route('user.index') }}";
                	},800);
	    		 }
	    		});

			}
		});
		$("#table_id").on('click', '.btn-show', function() {
			event.preventDefault();
			$('#modal-show').modal('show');
			/* Act on the event */
			var url = $(this).attr('data-url');
			console.log(url);
			$.ajax({
				url: url,
				type: 'GET',
				success: function(response){
					console.log(response);
					$("#user_name").text(response.data.name);
					$("#user_username").text(response.data.username);
					$("#user_email").text(response.data.email);
				},
			})
		});
		//bắt sự kiện click vào nút edit
		$("#table_id").on('click', '.btn-edit', function(e) {
        //mở modal edit lên
	        $('#modal-edit').modal('show');
	        e.preventDefault();
	        var url=$(this).attr('data-url');
	        console.log(url);
	        $.ajax({
	          type: 'get',
	          url: url,
	          success: function (response) {
	          	console.log(response);
	            $('#user_edit_name').val(response.data.name);
				$('#user_edit_username').val(response.data.username),
				$('#user_edit_email').val(response.data.email),
	            $('#user-form-edit').attr('data-url','{{ asset('admin/user/') }}/'+response.data.id)
	        	},
   			})
    	})
      //bắt sự kiện submit form edit
      $('#user-form-edit').submit(function (e) {
      	e.preventDefault();
        //lấy data-url của form edit
        var url=$(this).attr('data-url');
        $.ajax({
          //phương thức put
          type: 'put',
          url: url,
          //lấy dữ liệu trong form
          data: {
          	name: $('#user_edit_name').val(),
			username: $('#user_edit_username').val(),
			email: $('#user_edit_email').val(),
			password: $('#user_edit_password').val(),
			password_confirmation: $('#user_edit_password_confirm').val(),
          	_token: $('meta[name="csrf-token"]').attr('content'),
          },
          success: function (response) {
          	if(typeof response.errors != 'undefined'){
				var alert = "";
				for(var i=0;i<response.errors.length;i++){
					 alert += '<div class="err alert alert-danger">'+response.errors[i]+'</div>';
				}
				$('#user-error-edit').html(alert);
				setTimeout(function () {
					$('.err').remove();
                },5000);
			}else{
            //thông báo update thành công
	            toastr.success('edit success!')
	            //ẩn modal edit
	            $('#modal-edit').modal('hide');
	            setTimeout(function () {
	            	window.location.href="{{ route('user.index') }}";
	            },800);
	        }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //xử lý lỗi tại đây
        }
    })
    })    

  } );
	
</script>
@endsection