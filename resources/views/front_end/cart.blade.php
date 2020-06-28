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

</main>
@if(isset($cart) && $cart->getContents())
<h2>Shopping Cart Page</h2>
<div class="card table-responsive">
	<table class="table shopping-cart-wrap">
		<thead class="text-muted">
			<tr>
				<th scope="col">Product</th>
				<th scope="col" width="120">Quantity</th>
				<th scope="col" width="120">Price</th>
				<th scope="col" width="200" class="text-right">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($cart->getContents() as $title =>$product)
			
				<tr>
					<td>
						<figure class="media">
							<div class="img-wrap"><img src="{{asset('images/'.$product['product']->thumbnail)}}" style="width: 230px;height: 200px" class="img-thumbnail img-sm"></div>
							<figcaption class="media-body">
							<h6 class="title text-truncate">{{$product['product']->title}}</h6>
							<dl class="param param-inline small">
								<dt>Size: </dt>
								<dd>XXL</dd>
							</dl>
							<dl class="param param-inline small">
								<dt>Color: </dt>
								<dd>Orange color</dd>
							</dl>
							</figcaption>
						</figure>
					</td>
					<td>
							<form action="{{route('cart.update',$product)}}" method="POST" >	
						@csrf
						<input type="number" name="qty" id="qty" class="form-control text-center" min="0" max="99" value="{{$product['qty']}}">
					
						<input type="submit" name="update" value="Update" class="btn btn-block btn-outline-success btn-round">
</form>
					</td>
					<td>
						<div class="price-wrap">
							<span class="price">USD {{$product['price']}}</span>
							<small class="text-muted">{{$product['product']->price}}(USD each)</small>
							</div> <!-- price-wrap .// -->
						</td>
						<td class="text-right">
							<a href="{{route('cart.remove',$product)}}"   class="btn btn-sm btn-danger">Remove</a>
							
						</td>
					</tr>		
			</tbody>
				@endforeach
				<tr>
					<th >Total Qty: </th>
					<td>{{$cart->getTotalQty()}}</td>
				</tr>
				<tr>
					<th>Total Price: </th>
					<td>{{$cart->getTotalPrice()}}</td>
					<td></td>
					<td class="text-right"><a class="btn btn-success"  href="{{route('checkout.checkout')}}">Buy now</a></td>
				</tr>

				
			</tbody>
		</table>
		</div> 
		
		<!-- card.// -->
		@else
		<div class="col-sm-6 offset-sm-3">
			
		<p class="alert alert-danger">No Products in the Cart <a href="{{route('frontend')}}">Buy Some Products</a></p>
		</div>
		
	@endif
	@endsection
	