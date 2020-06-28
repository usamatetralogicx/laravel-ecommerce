<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    public function index()
    {
        $categories=Categories::paginate(5);
        return view('show_categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view('add_cat',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|min:4|unique:categories',
            'discription'=>'required|min:5|unique:categories'
        ]);
        $categories = Categories::create(['title'=>$request->title,'discription'=>$request->discription]);
        $categories->childrens()->attach($request->parent_id);
        if($categories)
        {
            return back()->with('message','Your categorey has been successfully added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
         $categories = Categories::all();
        return view('show_cat',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $categories = Categories::where('id','!=',$id)->get();
            $category=Categories::find($id);
            return view('add_cat',['category'=>$category,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
      
          $categories = Categories::find($request->id);
        $categories->title = $request->title;
        $categories->discription = $request->discription;
        $categories->childrens()->detach();
        $categories->childrens()->attach($request->parent_id);
        $saved=$categories->save();
        if($saved)
        {
        return back()->with('message','Your record has been successfully updated');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories=Categories::find($id);
        $deleted =   $categories->forcedelete();
        if($deleted)
            return back()->with('message','category has been successfully Deleted');
    }
      public function trash($id)
    {
         $categories=Categories::find($id);
        if($categories->delete()){
            return back()->with('message','Category Successfully Trashed!');
        }else{
            return back()->with('message','Error Deleting Record');
        }
    }
    public function show_trash()
    {
        $categories=categories::onlyTrashed()->paginate(3);
        return view('show_categories',compact('categories'));
    }
    public function recover_trash($id)
    {
        $categories=categories::onlyTrashed()->findorfail($id);
        if($categories->restore())
        {
            return back()->with('message','category ha been successfully recovered');
        }
    }
}

