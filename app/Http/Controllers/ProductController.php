<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Storeproduct;
use App\categories;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     */

    public function index()
    {
        $categories=categories::all();
         return view('products.products',compact('categories'));
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
    public function store(Storeproduct $request)
    {
        if($request->hasFile('thumbnail')&& $request->thumbnail->isValid())
        {
            $name = $request->thumbnail->getClientOriginalName();
            $extension =$request->thumbnail->extension();
            $size = $request->thumbnail->getSize();
            $filename = $name;
            $request->thumbnail->move(public_path('images'),$filename);
        }
         
         $product = Product::create([
           'title'=>$request->title,
           'description'=>$request->description,
           'price' => $request->price,
           'discount'=>$request->discount ? $request->discount : 0,
           'status' => $request->status,
           'total_price' => $request->total_price ? $request->total_price : 0,
           'thumbnail'=>$filename,
           'featured'=>$request->featured,
       ]);
          
         $product->categories()->attach($request->category_id);
         if($product)
         {
            return back()->with('message','product has been sucessfully added');
         }
         else
            {
                return back()->with('message','error');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) 
    {
        $products = Product::paginate(3);
        return view('products.show_product',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::all();
        $product=Product::find($id);
        return view('products.products',['product'=>$product,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Storeproduct $request, Product $product)
    {
        if($request->hasFile('thumbnail')&& $request->thumbnail->isValid())
        {
            $name = $request->thumbnail->getClientOriginalName();
            $extension =$request->thumbnail->extension();
            $size = $request->thumbnail->getSize();
            $filename = $name;
            $path = $request->thumbnail->storeAs('images',$filename,'public');
        }
         $product = Product::find($request->id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount =$request->discount ? $request->discount : 0;
        $product->status = $request->status;
        $product->total_price = $request->total_price;
        $product->thumbnail = $filename;
        $product->categories()->detach();
        $product->categories()->attach($request->category_id);
        $saved=$product->save();
        if($saved)
        {
        return back()->with('message','Your product has been successfully updated');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $products=Product::find($id);
         
        if($products->categories()->detach() && $products->forcedelete())
        {
            Storage::disk('public')->delete($products->thumbnail);
            return back()->with('message','Product has been successfully Deleted');
        }
    }
}
