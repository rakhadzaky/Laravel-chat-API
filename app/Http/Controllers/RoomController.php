<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rooms;

use App\User;

use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rooms::all();
    }

    public function own_room(){
        return User::find(Auth::user()->id)->rooms;
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
        $rooms = new Rooms;
        $rooms->room_name  = $request->room_name;
        $rooms->save();

        return "Save data success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Rooms::find($id);
    }

    public function show_own($id){
        return Rooms::find($id);
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
        if(Rooms::find($id)->delete()){
            return response()->json([
                'message' => 'Success Deleted Rooms',
                'status' => true,
            ], 201);
        }
        return response()->json([
            'message' => 'Failed Delete Rooms',
            'status' => false,
        ], 500);
    }
}
