@extends('layouts.admin')
@section('content')
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Edit User</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"> Edit User </li>
			</ol>
		</div>
	</div>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
		
		<div class="col-12">
			<div class="card">
				<div class="border-bottom title-part-padding">
					<h4 class="card-title mb-0">Edit User </h4>
				</div>
				<div class="result"></div>


				<div class="card-body min_height">
					<form name="user_edit1" id="user_edit1" method="post" action="javascript:void(0)" enctype="multipart/form-data">
						@csrf
					    <div class="row">
							<!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
							<input type="hidden" name="user_id" id="user_id" value="{{ $users->id }}">

							<div class="mb-3 col-md-4">
								<label for="Name" class="control-label" >Full Name:</label>
								<input type="text" id="full_name" value="{{$users->full_name}}" name="full_name" class="form-control" required>
							</div>
							<div class="mb-3 col-md-4">
								<label for="Name" class="control-label" >Employee Id:</label>
								<input type="text" id="lname" value="{{$users->employee_id}}" name="employee_id" class="form-control" required>
							</div>

							<div class="mb-3 col-md-4">
								<label for="Email" class="control-label">Emergency Contact No:</label>
								<input type="text" id="emergency_contact_no" pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$" name="emergency_contact_no" value="{{$users->emergency_contact_no}}" class="form-control" required>
								{{-- allready exit error --}}
								<label id="email_error" class="error"></label>
							</div>
							<div class="mb-3 col-md-4">
								<label for="username" class="control-label">Agency:</label>
								<input type="phone" id="agency" name="agency" value="{{$users->agency}}" class="form-control" required>
							{{-- allready exit error --}}
							<label id="name_error" class="error"></label>
							</div>
							<div class="mb-3 col-md-4">
								<label for="password" class="control-label">Valid Upto:<span style="color:Red">*</span></label>
								<input type="text" id="valid_upto" required name="valid_upto" value="{{$users->valid_upto}}" class="form-control">
							</div>

							<div class="mb-3 col-md-4">
								<label for="password" class="control-label">Level:<span style="color:Red">*</span></label>
								<input type="text" id="level" required name="level" value="{{$users->level}}" class="form-control">
							</div>

							<div class="mb-3 col-md-4">
								<label for="dob" class="control-label">DOB:</label>
								<input type="date" id="dob"  name="dob" class="form-control" value="{{$users->dob}}">
							</div>
							<div class="mb-3 col-md-4">
								<label for="doj" class="control-label">DOJ:</label>
								<input type="date" id="doj"  name="doj" class="form-control" value="{{$users->doj}}">
							</div>
							<div class="mb-3 col-md-4">
								<label for="work_station" class="control-label">Work Station:</label>
								<input type="text" id="work_station"  name="work_station" value="{{$users->work_station}}" class="form-control">
							</div>
							<div class="mb-3 col-md-4">
								<label for="date_of_training" class="control-label">Date of Training:</label>
								<input type="date" id="date_of_training"  name="date_of_training" value="{{$users->date_of_training}}" value="{{$users->date_of_training}}" class="form-control">
							</div>
							<div class="mb-3 col-md-4">
								<label for="authorized_by" class="control-label">Authorized by:</label>
								<input type="text" id="authorized_by"  name="authorized_by" value="{{$users->authorized_by}}" class="form-control">
							</div>
							<div class="mb-3 col-md-4">
								<label for="blood_group" class="control-label">Blood Group:</label>
								<input type="text" id="blood_group"  name="blood_group"  class="form-control" value="{{$users->blood_group}}">
							</div>
							<div class="mb-3 col-md-4">
								<label for="address" class="control-label">Address:</label>
								<textarea id="address"  name="address" class="form-control">{{$users->address}}</textarea>  
							</div>
							<div class="mb-3 col-md-4">
								<label for="username" class="control-label">Photograph:</label>
								<input type="file" id="iamge" name="image"  class="form-control">
							{{-- allready exit error --}}
						
							@if(!empty($users->image))
						    <img src="{{($users->image)}}" height="150" width="100" class="form-control" />
							@endif
							</div>



						
						</div>
						<!-- <a type="button" href="{{ url('/user_reviews') }}"class="btn btn-dark fa-pull-left mt-3">Back</a>
						<input type="submit" id="submit" value="Save" class="btn btn-success btn_submit fa-pull-right mt-3"> -->
						<a type="button" href="{{ route('user_list') }}" class="btn btn-dark fa-pull-left mt-3">Back</a>
						<input type="submit" id="submit" value="Submit" class="btn btn-success btn_submit fa-pull-right mt-3">
					</form>
				</div>
			</div>
		</div>
		
	</div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

<script>
	$("#user_edit1").validate({
	rules: {
	full_name: {required: true,},
	employee_id: {required: true},
	emergency_contact_no: {required: true,},
	agency:{ required:true, },
	emergency_contact_no:{ 
		required:true,
		minlength:10,
		maxlength:10
		}, 
	},
	valid_upto:{required:true,},
	level:{required:true,},

	messages: {
		full_name: {required: "Please enter full name",},
		employee_id: {required: "Please enter employee id",},
		emergency_contact_no: {required: "Please enter emergency contact no",},
		agency:{required: "Please enter agency",},
		valid_upto: {required: "Please enter valid upto",},
		level:{required:'Please enter level',},
		},
		submitHandler: function(form) {
		   var formData= new FormData(jQuery('#user_edit1')[0]);
		   host_url = "/development/employee_management/";
			jQuery.ajax({
				url:host_url+"updater-users",
				type: "post",
				cache: false,
				data: formData,
				processData: false,
				contentType: false,
				
				success:function(data) { 
				var obj = JSON.parse(data);
				if(obj.status==true){
					jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+obj.message+"</div>");
					setTimeout(function(){
						jQuery('.result').html('');
						window.location = host_url+"user_list";
					}, 2000);
				}else{
					if(obj.status==false){
						jQuery('.result').html("<div class='alert alert-success alert-dismissible text-white border-0 fade show' role='alert'><button type='button' class='btn-close btn-close-white' data-bs-dismiss='alert' aria-label='Close'></button><strong>Success - </strong> "+obj.message+"</div>");
					}
					
				}
				}
			});
		}
	});
</script>
@stop


