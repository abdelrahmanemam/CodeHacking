<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        
        return view('admin/users/index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('role','id')->all();
        return view('admin/users/create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:5',
                'email'=> 'email|required',
                'password'=> 'min:8',
                'is_active'=> 'required',
                'role_id'=>'required',
                'avatar'=>'image|nullable',
            ]
        );
        $input = $request->all();

        $input['password'] = bcrypt($request->get('password'));

        $user = User::create($input);

        if ($photo_name = $request->file('avatar')) {

            $name = time().'_'.$photo_name->getClientOriginalName();     //get photo original name and append timestamp to it

            $photo_name->move('images',$name);  //move the photo to images dir in public

            $photo = Photo::create([
                'path' => $name,
                'photoable_type' => "App\User",
                'photoable_id' => $user['id'],
            ]);

            $user->photo_id = $photo['id'];
        }
        $user->save();

        return redirect('admin/user');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
