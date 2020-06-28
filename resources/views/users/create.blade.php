@extends('dashboard.admin')
@section('breadcrumbs')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div id="mar"  class="col-lg-12">
   <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" ><a href="{{url('categories')}}">Categories</a></li>
    <li class="breadcrumb-item "><a href="{{url('product')}}"> Product</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add/Edit Categories</li>
  </ol>
</nav>
</div>
@endsection
@section('content')

 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">User</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>
     
      <form  action="@if(@$profiles){{url('update_users'.@$profiles->id)}} @else {{route('add_user')}} @endif"  method="POST" role="form" enctype="multipart/form-data">
      	 @if(@$profiles)
        @method('PUT')
        @endif
      @csrf
	
      @if(session()->has('message'))

      <div>
        <p class="alert alert-info">{{session('message')}}</p>
      </div>
      @endif
       @if ($errors->any()) 
            @foreach ($errors->all() as $error)
            <div class="col-lg-7 offset-lg-2">
                <p class="alert alert-danger">{{ $error }}</p>
            </div>
            @endforeach
            
@endif
      	<div class="form-row">
      	<div class="col-sm-9">
      	<div class="form-group row">
      		<div class="col-sm-6">
      		<label for="">Name:</label>
      		<input type="text" class="form-control" id="" name="name" placeholder="Enter Name" value="{{@$profiles->name}}{{old('name')}}">
      	</div>
      	<div class="col-sm-6">
      		<label for="">Email:</label>
      		<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">@</span>
					</div>
					<input type="text" class="form-control" placeholder="Email" aria-label="Username"  aria-describedby="basic-addon1" name="email" value="{{@$users->email}}{{old('email')}}"/>
      	</div>
      </div>
      </div>
      		
      	<div class="form-group row">
      		<div class="col-sm-6">
      		<label for="">Password:</label>
      		<input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Enter password">
      	</div>
      	<div class="col-sm-6">
      		<label for=""> Confirm Password:</label>
      		<input type="password" name="confirm_password" class="form-control" value="{{old('confirm_password')}}" placeholder="Enter password">
      	</div> 
      </div>

      	<div class="form-group row">
      		<div class="col-sm-6">
      		<label for="">Status:</label>
      		<select name="status" class="custom-select" id="countries">
						<option value="0">Select a Status</option>
						<option value="1" @if(isset($users) && @$users->status == 1){{'selected'}} @endif>Active</option>
						</select>
    
      		  	</div>
      	<div class="col-sm-6">
      		<label for="">Role:</label>
      		<select name="role" class="custom-select" id="countries">
						<option value="0">Select a Role</option>
						<option  @if(isset($users) && @$users->role == 'Customer'){{'selected'}} @endif>Customer</option>
						</select>
      	</div> 
      </div>
		<h3>Address</h3>
		<div class="form-group">
			<label>Address:</label>
			<input type="text" name="address" class="form-control" value="{{@$profiles->address}}{{old('address')}}" placeholder="">
			
		</div>
      	<div class="form-group row">
      		<div class="col-sm-6">
      		<label for="">Country:</label>
					<select name="country" class="custom-select" id="countries">
						<option value="0">Select a Country</option>
						<option>Pak</option>
						</select>
      	</div>
      	<div class="col-sm-6">
      		<label for="">State:</label>
      		<input type="text" name="state" class="form-control" value="{{@$profiles->state}}{{old('state')}}" placeholder="Enter state">
      	</div>
      		</div>
      	<div class="form-group row">
      		<div class="col-sm-6">
      		<label for="">City:</label>
      		<input type="text" class="form-control" name="city" value="{{@$profiles->city}}{{old('city')}}" placeholder="Enter city">
      	</div>
      	<div class="col-sm-6">
      		<label class="form-control-label">Phone: </label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input type="text" class="form-control" placeholder="Phone Number" aria-label="Username"  aria-describedby="basic-addon1" name="phone" value="{{@$profiles->phone}}{{old('phone')}}"/>
      	</div>
      		</div>
      	</div>
      		
		
</div>  
	<div class="col-sm-3" style="padding-left:15px">
		<ul class="list-group row">
				<li class="list-group-item active"><h5>Profile Image</h5></li>
			<li class="list-group-item">
				<div class="input-group mb-3">
					<div class="custom-file ">
						<input type="file"  class="custom-file-input" name="thumbnail" id="thumbnail">
						<label class="custom-file-label" for="thumbnail">Choose file</label>
					</div>
				</div>
				<div class="img-thumbnail  text-center">
					<img src="@if(@$profiles){{asset('users_img/'.@$profiles->thumbnail)}} @else{{asset('images/no-thumbnail.jpeg')}} @endif" style="height: 100px;width: 230px;" id="imgthumbnail" class="img-fluid" alt="">
				</div>
			</li>
			</li>
			<li class="list-group-item">
				<div class="col-12">
					<div class="input-group mb-3">
						@if(@$profiles)
		  <button type="submit" class="btn btn-primary btn-block">Update User</button>
		  @else
		  <button type="submit" class="btn btn-primary btn-block">Add User</button>
		  @endif
		
					</div>
				</div>
			</li>
	
    
			</li>
			</li>
		</ul>
	</div>

</div>
      </form>
@endsection
@section('scripts')
 <script type="text/javascript">
 	$('#select2').select2({
			placeholder: "Select multiple Categories",
		allowClear: true
		});
 $('#thumbnail').on('change', function() {
var file = $(this).get(0).files;
var reader = new FileReader();
reader.readAsDataURL(file[0]);
reader.addEventListener("load", function(e) {
var image = e.target.result;
$("#imgthumbnail").attr('src', image);
});
});
</script>
@endsection