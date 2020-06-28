
@extends('front_end.front_end')
@section('contents')
  <body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="{{asset('images/no-thumbnail.jpeg')}}" alt="" width="72" height="72">
    <h2>Checkout form</h2>
    <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
  </div>
<div class="col-sm-5 offset-sm-3"> 
    
  @if(session()->has('message'))
     <p class="alert alert-info">
       {{ session()->get('message')}}
     </p>
     @endif
     </div>
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">{{$cart->gettotalQty()}}</span>
      </h4>
      <ul class="list-group mb-3">
            @foreach($cart->getContents() as $title =>$product)
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">{{$product['product']->title}}</h6>
            <small class="text-muted">{{$product['qty']}}</small>
          </div>
          <span class="text-muted">Rs.{{$product['price']}}</span>
        </li>
          @endforeach
     
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong>Rs.{{$cart->getTotalPrice()}}</strong>
        </li>
      </ul>

      <form class="card p-2"  >
        @csrf
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Promo code">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <form class="needs-validation" novalidate action="{{route('checkout.checkout1')}}" method="POST" id="payment-form">
        @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="" name="first_name">
            @if($errors->has('first_name'))
            <div class="alert alert-danger">
              {{$errors->first('first_name')}}
            </div>
            @endif
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" placeholder="" value="" name="last_name">
             @if($errors->has('last_name'))
            <div class="alert alert-danger">
              {{$errors->first('last_name')}}
            </div>
            @endif
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" id="username" placeholder="Username" name="username">
            @if($errors->has('username'))
            <div class="alert alert-danger"> 
              {{$errors->first('username')}}
            </div>
            @endif
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="email" placeholder="you@example.com" name="email">
          @if($errors->has('email'))
            <div class="alert alert-danger">
              {{$errors->first('email')}}
            </div>
            @endif
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" placeholder="1234 Main St" name="address_1">
          @if($errors->has('address_1'))
            <div class="alert alert-danger">
              {{$errors->first('address_1')}}
            </div>
            @endif
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" id="address2" placeholder="Apartment or suite" name="address_2">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" id="country" name="country">
              <option value="">Choose...</option>
              <option>United States</option>
            </select>
            @if($errors->has('country'))
            <div class="alert alert-danger">
              {{$errors->first('country')}}
            </div>
            @endif
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" id="state" name="state">
              <option value="">Choose...</option>
              <option>California</option>
            </select>
            @if($errors->has('state'))
            <div class="alert alert-danger">
              {{$errors->first('state')}}
            </div>
            @endif
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" id="zip" placeholder="" name="zip">
            @if($errors->has('zip'))
            <div class="alert alert-danger">
              {{$errors->first('zip')}}
            </div>
            @endif
          </div>
        </div>
        <hr class="mb-4">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="same-address" name="shipping_address">
          <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="save-info">
          <label class="custom-control-label" for="save-info">Save this information for next time</label>
        </div>
      
        <div id="shipping-address">
            <hr class="mb-4">
<h4 class="mb-3">Shipping  address</h4>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>


        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" id="country" required>
              <option value="">Choose...</option>
              <option>United States</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" id="state" required>
              <option value="">Choose...</option>
              <option>California</option>
            </select>
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" id="zip" placeholder="" required>
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        </div>
      </div>
        <hr class="mb-4">
        <script src="https://js.stripe.com/v3/"></script>
         <div class="form-row">
    <label for="card-element">
      Credit or debit card
    </label>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>
  </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit">checkout</button>
      </form>
    </div>
  </div>

</div>
@endsection
@section('scripts')
<script>
  $(function(){
    $('#same-address').on('change',function(){
      $('#shipping-address').slideToggle(!this.checked);
    });
  });
</script>
@endsection
