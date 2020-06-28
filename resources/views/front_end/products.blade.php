
@extends('front_end.front_end')
@section('contents')
<main role="main">
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Online Shopping Site </h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>
    </div>
  </section>
  <div class="col-sm-5 offset-sm-3"> 
    
  @if(session()->has('message'))
     <p class="alert alert-info">
       {{ session()->get('message')}}
     </p>
     @endif
     </div>
 
  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top img-thumbnail" src="{{asset('images/'.$product->thumbnail)}}" alt="">
            <div class="card-body">{{$product->title}}
              <p class="card-text">{!!$product->description!!}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a class="btn btn-sm btn-outline-secondary" href="{{route('single',$product)}}">View</a>
                  <a class="btn btn-sm btn-outline-success" href="{{route('cart.add',$product)}}">Add to chart</a>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
       
          </div>
        </div>
            @endforeach
          </div>

        </div>
        
      </div>
    
</main>
<div class="row" style="margin-left: 80px">
         {{$products->links()}}
       </div>
@endsection     
