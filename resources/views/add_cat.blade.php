@extends('dashboard.admin')
@section('content')
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
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Categories</h1>
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

      <div class="col-sm-9 offset-sm-1">
      <form action=" @if(@$category){{url('update_categories'.@$category->id)}} @else {{route('add_cat')}} @endif" method="POST" role="form">
        @if(@$category)
        @method('PUT')
        @endif
      @csrf
       @if ($errors->any()) 
            @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
            @endforeach
            
@endif

      @if(session()->has('message'))

      <div>
        <p class="alert alert-info">{{session('message')}}</p>
      </div>
      @endif
        <div class="form-group">
          <label>Title:</label>
          <input type="text" class="form-control" name="title" value="{{@$category->title}} {{old('title')}}">
        </div>
        <div class="form-group">
          <label >Discription:</label>
          <textarea name="discription" rows="4" id="editor" class="form-control" >{!!@$category->discription!!}{!!old('discription')!!}</textarea>
        </div>
        <div class="form-group">
        @php 
      $ids = (isset($category->childrens) && $category->childrens->count() > 0 ) ? array_pluck($category->childrens, 'id') : null
    @endphp
             <label class="form-control-label">Select Category:</label>
        <select name="parent_id[]" id="parent_id" class="form-control"  multiple="multiple">
          @if(isset($categories))
          <option value="0">Top value</option>
          @foreach($categories as $categorys)
          <option value="{{$categorys->id}}"@if(!is_null($ids) && in_array($categorys->id, $ids)) {{'selected'}} @endif >
            {{$categorys->title}}</option>
          @endforeach
          @endif
        </select>
      </div>
        <div>
          @if(@$category)
        <button id="btn2" type="submit" class="btn btn-primary">Update</button>
        @else
        <button id="btn2" type="submit" class="btn btn-primary">Submit</button>
        @endif
      </div>
      </form>
    </div>
    @endsection
    @section('scripts')
    <script type="text/javascript">
$(document).ready(function() {
    $('#parent_id').select2();
});
ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( err => {
            console.error( err.stack );
        } );
</script>

@endsection

