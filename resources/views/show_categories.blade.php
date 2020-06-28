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
              <th>Title</th>
              <th>Discription</th>
              <th>Categories</th>
              <th>Created at</th>
              <th>Updated at</th>
              <th>Actions</th>
            </tr>
          </thead>
         
          <tr>
             @foreach($categories as $category)
            <td>{{$category->id}}</td>
            <td>{{$category->title}}</td>
            <td>{!!$category->discription!!}</td>
            <td>
              @if($category->childrens()->count()>0)
              @foreach($category->childrens as $children)
              {{$children->title}},
              @endforeach
              @else
              <strong>{{"parent category"}}</strong>
              @endif
            </td>
k            <td>{{$category->created_at}}</td>
            <td>{{$category->updated_at}}</td>
            <td>
              @if($category->trashed())
              <a href="{{url('edit_categories'.$category->id)}}" class="btn btn-success btn-sm" title="">Edit</a> | <a href="{{url('recover_trash'.$category->id)}}" class="btn btn-secondary btn-sm" title="">Recover</a> 
             
              
              @else

              <a href="{{url('edit_categories'.$category->id)}}" class="btn btn-success btn-sm" title="">Edit</a> | <a href="{{url('trash_categories'.$category->id)}}" class="btn btn-secondary btn-sm" title="">Trash</a> | <a href="javascript:;" onclick="deleterecord('{{$category->id}}')" class="btn btn-danger btn-sm" title="">Delete</a>
                <form id="delete_category-{{$category->id}}" action="{{route('delete_cat',$category->id)}}" method="POST"
                 style="display: none;">
                 @method('DELETE')
                @csrf
                </form>
            </td>
              
@endif
          </tr> 
             @endforeach
             
        </table>
      </div>
       
       <div>
         {{$categories->links()}}
       </div>
     
        
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