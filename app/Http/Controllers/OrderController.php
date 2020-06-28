<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\ordervalidation;
use App\Cart;
use Session;
use App\Customer;
use Stripe\Stripe;
use Stripe\Charge;
use DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ordervalidation $request)
    {
        $error = '';
        $success = '';
        $cart = [];
        $order = '';
        $checkout = '';  
  Stripe::setApiKey("sk_test_wFIolcojrSyUe0yXVJSoeeva00ZUSh0F3a");     

        if(Session::has('cart'))
        {
            $cart=Session::get('cart');
            $charge=Charge::create([
      "amount" => $cart->getTotalPrice()*100,
      "currency" => "eur",
      "source"   => $request->stripeToken, // obtained with Stripe.js
      "description" => $request->email,
    ]);
        }
        if(isset($charge))
        {
            if($request->shipping_address)
            {
                $customers = [
                    'billing_firstName'=>$request->first_name,
                    'billing_lastName'=>$request->last_name,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'billing_address_1'=>$request->address_1,
                    'billing_address_2'=>($request->address_2) ? $request->address_2 : null,
                    'billing_country'=>$request->country,
                    'billing_state'=>$request->state,
                    'billing_zip'=>$request->zip,
                ];
                DB::beginTransaction();
        $checkout = Customer::create($customers);
        foreach ($cart->getContents() as $title => $product) {
            $products = [
                'Customer_id' => $checkout->id,
                'product_id' => $product['product']->id,
                'qty' => $product['qty'],
                'status' => 'Pending',
                'price' => $product['price'],
                'payment_id' => 0,
            ];
            $order = Order::create($products);
        }

        if ($checkout && $order) {
            DB::commit();
            $request->session()->forget('cart');
            return redirect('frontend')->with('message', 'Your Order Successfully Processed');
        } else {
            DB::rollback();
            return redirect('checkout')->with('message', 'Invalid Activity!');
        }

}
}
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    public function addToCheckout()
    {
if (!Session::has('cart') || empty(Session::get('cart')->getContents())) {
             return view('front_end.cart')->with('message', 'No Products in the Cart');
        }
        else{
        $cart = Session::get('cart');
        return view('front_end.checkout',compact('cart'));
    }
}
}