<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $data = array();
        $input = array(
            'first_name'=>$request->post('first_name'),
            'last_name'=>$request->post('last_name'),
            'email'=>$request->post('email'),
            'pasword'=>bcrypt($request->post('password')),
            'remember_token'=>Str::random(64),
        );
        $user = User::create($input);
        $data['data']=  'Congratulations'.' '.$user->first_name.' '.$user->last_name.' '.'You have been Register Successfully';
        $data['status'] = '200 OK';
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
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
       $user = User::find($id);
       $user->update($request->all());
       return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       User::destroy($id);
    }
    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            //$success['token'] =  $user->createToken('MyApp')-> accessToken;
            $data = array();
            $data['status'] = '200 OK';
            $data['success'] = 'User Login Successfully!';
            return response()->json([$data]);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
}
