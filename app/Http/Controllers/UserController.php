<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

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
        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->save();

        return "Save Data Success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $id)
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
        
        $users = User::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->save();

        return "Update Berhasil";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return "Delete berhasil";
    }

    public function who_am_i(){
        return Auth::user();
    }

    public function login_proses(Request $req){
        $email = $req->json()->get('email');
        $password = $req->json()->get('password');
        $data_user = User::where('email','=',$email)->first();
        if ($data_user) {
            if (Hash::check($password, $data_user->password)){
                $token = $data_user->createToken('User Token')->accessToken;
                return response()->json([
                    'Status' => true,
                    'token' => $token,
                ]);
            }
            return response()->json([
                'Status' => false,
                'error' => 'User does not exist',
            ]);
        }
        return response()->json([
            'Status' => false,
            'error' => 'Failed to Login',
        ]);
    }

    public function logout_proses(){
        $data_user = Auth::user();
        $revoke = $data_user->token()->revoke();

        if ($revoke) {
            return response()->json([
                'Status' => 'Success',
                'message' => 'Logout Success',
            ]);
        }
        return response()->json([
            'Status' => 'Failed',
            'message' => 'Failed Logou',
        ], 500);
    }
}
