<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Persons;

use App\Chats;

use App\Rooms;

use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
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

    public function Chat_In_Room($id){
        return Rooms::find($id)->chats;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $uid = Auth::user()->id;
        $data = [
            'user_id' => $uid,
            'room_id' => $id,
            'message' => $request->message,
        ];
        $create = Chats::create($data);
        if ($create) {
            return response()->json([
                'status' => true,
                'message' => 'Seucces Input Message',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Failed, Something went wrong',
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
    public function destroy($id)
    {
        //
    }
}
