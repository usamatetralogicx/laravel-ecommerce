
@extends('front_end.front_end')
@section('contents')
<main role="main">
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Online Shopping Site </h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
      <p>
        <a href="#" class="btn btn-primary ">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>
    </div>
  </section>
<div class="col-sm-6 offset-sm-3">
     @if(session()->has('message'))
     <p class="alert alert-info">
       {{ session()->get('message')}}
     </p>
     @endif
   </div>
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
     <div class="col-sm-4">
       <img class="img-thumbnail" src="{{asset('images/'.$product->thumbnail)}}" alt="">
           
     </div>
     <div class="col-sm-8">
      <table  class="table shopping-cart-wrap">  
          <tr>
            <th  colspan="1">Title</th>
            <td>{{$product->title}}</td>
          </tr>
        <tbody>
          <tr>
            <th  colspan="1">Description</th>
            <td>{!!$product->description!!}</td>
          </tr>
          <tr>
            <th  colspan="1">Price</th>
            <td>{{$product->price}}</td>
          </tr>
          <tr>
            <th  colspan="1">Discount</th>
            <td>{{$product->discount}}</td>
          </tr>
          <tr>
            <th  colspan="1">Total Price</th>
            <td>{{$product->total_price}}</td>
          </tr>
        </tbody>
      </table>
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <a class="btn btn-outline-success" href="{{route('add',$product)}}">Add to chart</a>
                </div>
                <small class="text-muted">{{$product->created_at}}</small>
              </div>
            </div>
          </div>
        </div>
      </div>
</main>
     
@endsection