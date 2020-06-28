@extends('dashboard.admin')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  
  
  <div  id="mar" class="col-lg-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" ><a href="{{url('categories')}}">Categories</a></li>
        <li class="breadcrumb-item "><a href="{{url('product')}}"> Product</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Categories</li>
      </ol>
    </nav>
  </div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Users</h1>
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
  
  @if(session()->has('message'))
  <div class="col-sm-9 offset-sm-1">
    <p class=" alert alert-danger">{{session('message')}}</p>
  </div>
  @endif
  <div class="table-responsive">
    <table class="table table-striped table-sm text-center">
      <thead>
        <tr>
          <th>id</th>
          <th>Name</th>
          <th>Address</th>
          <th>Email</th>
          <th>Country</th>
          <th>phone</th>
          <th>Status</th>
          <th>Image</th>
          <th>Actions</th>
        </tr>
      </thead>
      
      <tr>
        @foreach($profiles as $profile)
        <td>{{$profile->id}}</td>
        <td>{{$profile->name}}</td>
        <td>{{$profile->address}}</td>
        <td>{{$profile->user->email}}</td>
        <td>{{$profile->country}}</td>
        <td>{{$profile->phone}}</td>
        <td>{{$profile->user->status}}</td>
       <td><img src="{{asset('users_img/'.$profile->thumbnail)}}" style="height: 60px;width: 90px;"></td>
        <td>
          <a href="{{url('edit_profile'.$profile->id)}}" class="btn btn-success btn-sm" title="">Edit</a> | <a href="javascript:;" onclick="deleterecord('{{$profile->id}}')" class="btn btn-danger btn-sm" title="">Delete</a>
          <form id="delete_category-{{$profile->id}}" action="{{route('delete',$profile->id)}}" method="POST"
            style="display: none;">
            @method('DELETE')
            @csrf
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
  
  
@endsection
@section('scripts')
<script type="text/javascript">
function deleterecord(id)
{
let choice = confirm("Are you sure to delete this record");
if (choice)
{
document.getElementById('delete_category-'+id).submit();
}
}
</script>
@endsection