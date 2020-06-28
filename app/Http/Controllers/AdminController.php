<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Session;
class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware(['auth','admin']);
    }
    public function index()
    {
    	return view('bootstrap');
    }
    public function show()
    {
        //dd(Session::get('cart'));
    	$products= Product::paginate(3);
    	return view('front_end.products',compact('products'));
    }
    public function single(Product $product)
    {
        return view('front_end.single',compact('product'));
    }
    public function addToCart(Product $product, Request $request)
    {
        $oldcart = Session::has('cart') ? Session::get('cart') : null;
        $qty =$request->qty ? $request->qty :1;
        $cart = new Cart($oldcart);
        $cart->addProduct($product, $qty);
        Session::put('cart', $cart);
        return redirect('cart')->with('message',"Product $product->title has been successfully added to cart"); 
    }
    public function cart()
    {
        if(!Session::has('cart'))
        {
            return view('front_end.cart');
        }
        else
        {
        $cart = Session::get('cart');

        return view('front_end.cart',compact('cart'));
        }
    }
      public function removeProduct(Product $product){
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->removeProduct($product);
      Session::put('cart', $cart);
      return back()->with('message', "Product $product->title has been successfully removed From the Cart");
   }
    public function updateProduct(Product $product, Request $request)
    {
        $oldcart = Session::has('cart') ? Session::get('cart') : null;
        $qty =$request->qty ? $request->qty :1;
        $cart = new Cart($oldcart);
        $cart->updateProduct($product, $qty);
        Session::put('cart', $cart);
        return redirect('cart')->with('message',"Product $product->title has been successfully updated to cart"); 
    }
    public function addToCheckout()
    {
        return view('front_end.checkout');
    }
}
