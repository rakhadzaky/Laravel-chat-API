<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Persons;

use App\Rooms;

use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Persons::all();
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
    public function store($id, Request $request){
        $data_room = [
            'room_name' => $request->room_name,
        ];
        $create_room = Rooms::create($data_room)->room_id;
        if ($create_room) {
            $data_person1 = [
                'room_id' => $create_room,
                'user_id' => Auth::user()->id,
            ];
            $create_person1 = Persons::create($data_person1);
            $data_person2 = [
                'room_id' => $create_room,
                'user_id' => $id,
            ];
            $create_person2 = Persons::create($data_person2);
            if ($create_person1 && $create_person2) {
                return response()->json([
                    'status' => true,
                    'message' => '2 person has joined the room',
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'failed to join room',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'failed to create new room',
        ]);
    }
    
     public function add_person($id, Request $request)
    {
        $data = [
            'room_id' => $id,
            'user_id' => $request->user_id
        ];
        $save = Persons::create($data);
        if ($save) {
            return response()->json([
                'status' => true,
                'message' => 'Person Success Join Room',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Person Failed to Join Room, Somehting went wrong',
        ]);
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
    public function destroy($id, $uid)
    {
        $data = [
            'room_id' => $id,
            'user_id' => $uid,
        ];
        $delete = Persons::where($data)->delete();
        if ($delete) {
            return response()->json([
                'status' => true,
                'message' => 'Success delete user from room'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Failed delete user from room'
        ]);
    }

    public function room_persons($id){
        $data = Rooms::find($id)->users;
        if ($data) {
            return response()->json([
                'count' => Rooms::find($id)->users()->count(),
                'data' => $data,
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Nothing can be display, Something went wrong',
        ]);
    }
}
