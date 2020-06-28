<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\uservalidation;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.create');
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
    public function store(uservalidation $request)
    {
        $name = 'images/no-thumbnail.jpeg';

        if($request->hasFile('thumbnail')&& $request->thumbnail->isValid())
        {
            $name = $request->thumbnail->getClientOriginalName();
            $extension =$request->thumbnail->extension();
            $size = $request->thumbnail->getSize();
            // $filename = $name;
            $request->thumbnail->move(public_path('users_img'),$name);
        }
           $users = User::create([
           'email'=>$request->email,
           'password'=>bcrypt($request->password),
           'status' => $request->status,
           'role'=>$request->role,

       ]);
           if($users)
           {
            $profile =Profile::create([
                'user_id'=>$users->id,
                'name'=>$request->name,
                'address'=>$request->address,
                'country'=>$request->country,
                'state'=>$request->state,
                'city'=>$request->city,
                'phone'=>$request->phone,
                'thumbnail'=>$name,

            ]);
           }
          if($users)
         {
            return back()->with('message','User has been sucessfully added');
         }
         else
            {
                return back()->with('message','error');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $profiles = Profile::all();
        return view('users.show',compact('profiles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        $profiles=Profile::find($id);
        return view('users.create',compact('profiles','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
         $users_id = User::find($request->id);
         $users_id->email=$request->email;
          $users_id->password = $request->password;
        $users_id->status = $request->status;
        $users_id->role = $request->role;
        $users =$users_id->save();
        if($request->hasFile('thumbnail')&& $request->thumbnail->isValid())
        {
            $name = $request->thumbnail->getClientOriginalName();
            $extension =$request->thumbnail->extension();
            $size = $request->thumbnail->getSize();
            $filename = $name;
            $request->thumbnail->move(public_path('users_img'),$filename);
        }
       
           if($users)
           {
            $profiles = Profile::find($request->id);
            $profiles->name = $request->name;
            $profiles->address = $request->address;
            $profiles->country = $request->country;
            $profiles->state = $request->state;
            $profiles->city = $request->city;
            $profiles->phone = $request->phone;
            $profiles->thumbnail = $filename;
                  $user=$profiles->save();
           }
          if($user)
         {
            return back()->with('message','User has been sucessfully updated');
         }
         else
            {
                return back()->with('message','error');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
    //   $profiles=Profile::find($id);
    //     $deleted =   $profiles->forcedelete();
    //     if($deleted)
    //         return back()->with('message','User has been successfully Deleted');
    // }
            }
}
