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
        <h1 class="h2">Product</h1>
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
     
      <form action="@if(@$product){{url('update_product'.@$product->id)}} @else {{route('add_pro')}} @endif" method="POST" role="form" enctype="multipart/form-data">
      	 @if(@$product)
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
      	<div class="form-group ">
      		<label for="">Title</label>
      		<input type="text" class="form-control" id="" name="title" placeholder="Enter Title" value="{{@$product->title}}{{old('title')}}">
      	</div>
      		
      	<div class="form-group">
      		<label for="">Discription</label>
	      		<textarea id="editor" name="description" rows="6" placeholder="Enter discription" class="form-control" >{!!@$product->description!!}{!!old('description')!!} </textarea>
      	</div> 
      	<div class="form-group row">
			<div class="col-6">
				<label class="form-control-label">Price: </label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input type="text" class="form-control" placeholder="0.00" aria-label="Username"  aria-describedby="basic-addon1" name="price" value="{{old('price')}}{{@$product->price}}" />
				</div>
			</div>
			<div class="col-6">
				<label class="form-control-label">Discount: </label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input type="text" class="form-control" name="discount_price" placeholder="0.00" aria-label="discount_price" value="{{@$product->discount}}{{old('discount_price')}}" aria-describedby="discount" value="" />
				</div>
				</div>
				<div class="col-6">
				<label class="form-control-label">Total Price: </label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input type="text" class="form-control" name="total_price" value="{{@$product->total_price}}{{old('total_price')}}" placeholder="0.00"   />
				</div>
			</div>
			</div>
		@if(@$product)
		  <button type="submit" class="btn btn-primary">Update product</button>
		  @else
		  <button type="submit" class="btn btn-primary">Add product</button>
		  @endif
</div>  
	<div class="col-sm-3" style="padding-left:15px">
		<ul class="list-group row">
			<li class="list-group-item active"><h5>Status</h5></li>
			<li class="list-group-item">
				<div class="form-group row">
					<select class="form-control" id="status" required="" name="status" value="{{old('status')}}">
						<option selected>choose..</option>
						<option value="0" @if(isset($product) && @$product->status == 0){{'selected'}} @endif >Pending</option>
						<option value="1"@if(isset($product) && @$product->status == 1){{'selected'}} @endif   >Publish</option>
					</select>
				</div>
				
				<li class="list-group-item active"><h5>Feaured Image</h5></li>
			<li class="list-group-item">
				<div class="input-group mb-3">
					<div class="custom-file ">
						<input type="file"  class="custom-file-input" name="thumbnail" id="thumbnail">
						<label class="custom-file-label" for="thumbnail">Choose file</label>
					</div>
				</div>
				<div class="img-thumbnail  text-center">
					<img src="@if(@$product){{url('images/'.@$product->thumbnail)}} @else{{asset('images/no-thumbnail.jpeg')}} @endif" style="height: 100px;width: 230px;" id="imgthumbnail" class="img-fluid" alt="">
				</div>
			</li>
			</li>
			<li class="list-group-item">
				<div class="col-12">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" ><input id="featured" type="checkbox" name="featured" value="" @if(@$product->featured == 1){{'selected'}} @endif></span>
						</div>
						<p type="text" class="form-control" name="featured" placeholder="0.00" aria-label="featured" aria-describedby="featured" >Featured Product</p>
					</div>
				</div>
			</li>
			  @php 
      $ids = (isset($product->categories) && $product->categories->count() > 0 ) ? array_pluck($product->categories, 'id') : null
    @endphp
			<li class="list-group-item active"><h5>Select Categories</h5></li>
			<li class="list-group-item ">
				<select name="category_id[]" id="select2" class="form-control" multiple="multiple">
          <option value="0">Top value</option>
          @foreach($categories as $categorys)
          <option value="{{$categorys->id}}"@if(!is_null($ids) && in_array($categorys->id, $ids)) {{'selected'}} @endif >
            {{$categorys->title}}</option>
          @endforeach
         
        </select>
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

		ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( err => {
            console.error( err.stack );
        } );
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