@extends('layouts.admin')
@section('content')
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">Add New User</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add New User</li>
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
					<h4 class="card-title mb-0">Add User</h4>
				</div>
				<div class="card-body min_height">
					<form name="user_add" id="user_add" method="post" action="javascript:void(0)" enctype="multipart/form-data">
						@csrf
					    <div class="row">
							<div class="">
								<!-- Alert Append Box -->
							<div class="result"></div>
							</div>
							<div class="mb-3 col-md-6">
								<label for="Name" class="control-label" >Full Name: <span style="color:Red">*</span> </label>
								<input type="text" required id="full_name" name="full_name" class="form-control">
							</div>
							<div class="mb-3 col-md-6">
								<label for="Email" class="control-label">Employee Id: <span style="color:Red">*</span></label>
								<input type="text" id="employee_id" name="employee_id" required class="form-control">
								{{-- allready exit error --}}
								<label id="employee_id_error" class="error"></label>
							</div>
							<div class="mb-3 col-md-6">
								<label for="emergency_contact_no" class="control-label">Emergency Contact No:<span style="color:Red">*</span></label>
								<input type="text" id="emergency_contact_no" required minlength="10" maxlength="10" name="emergency_contact_no" pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$" name="emergency_contact_no" class="form-control">
								{{-- allready exit error --}}
								<label id="emergency_contact_no_error" class="error"></label>
							</div>
                            <div class="mb-3 col-md-6">
								<label for="password" class="control-label">Agency:<span style="color:Red">*</span></label>
								<input type="text" id="agency" name="agency" required class="form-control">
							</div>
							<div class="mb-3 col-md-6">
								<label for="password" class="control-label">Valid Upto:<span style="color:Red">*</span></label>
								<input type="text" id="valid_upto" required name="valid_upto" class="form-control">
							</div>

							<div class="mb-3 col-md-6">
								<label for="password" class="control-label">Level:<span style="color:Red">*</span></label>
								<input type="text" id="level" required name="level" class="form-control">
							</div>
							
							<div class="mb-3 col-md-6">
								<label for="dob" class="control-label">DOB:</label>
								<input type="date" id="dob"  name="dob" class="form-control">
							</div>
							<div class="mb-3 col-md-6">
								<label for="doj" class="control-label">DOJ:</label>
								<input type="date" id="doj"  name="doj" class="form-control">
							</div>
							<div class="mb-3 col-md-6">
								<label for="work_station" class="control-label">Work Station:</label>
								<input type="text" id="work_station"  name="work_station" class="form-control">
							</div>
							<div class="mb-3 col-md-6">
								<label for="date_of_training" class="control-label">Date of Training:</label>
								<input type="date" id="date_of_training"  name="date_of_training" class="form-control">
							</div>
							<div class="mb-3 col-md-6">
								<label for="authorized_by" class="control-label">Authorized by:</label>
								<input type="text" id="authorized_by"  name="authorized_by" class="form-control">
							</div>
							<div class="mb-3 col-md-6">
								<label for="blood_group" class="control-label">Blood Group:</label>
								<input type="text" id="blood_group"  name="blood_group" class="form-control">
							</div>
							<div class="mb-3 col-md-6">
								<label for="address" class="control-label">Address:</label>
								<textarea id="address"  name="address" class="form-control"></textarea>  
							</div>
							<div class="mb-3 col-md-6">
								<label for="username" class="control-label">Photograph:</label>
								<input type="file" id="iamge" name="image"  class="form-control">
							{{-- allready exit error --}}
							<label id="image_error" class="error"></label>
							</div>

							



						</div>
						<a type="button" href="{{ route('user_list') }}" class="btn btn-dark fa-pull-left mt-3">Back</a>
						<input type="submit" id="submit" value="Add" class="btn btn-success btn_submit fa-pull-right mt-3">
					</form>
				</div>
			</div>
		</div>
		
	</div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@stop


