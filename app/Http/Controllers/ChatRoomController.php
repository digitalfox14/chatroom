<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;

use Auth;
use App\Models\User;

class ChatRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('chatroom/index', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = new ChatRoom;
        $messages->message = $request->message;
        $messages->sender_id = Auth::id();
        $messages->receiver_id = $request->receiver_id;
        
        $messages->save();
        return redirect()->route('chatroom');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChatRoom  $chatRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ChatRoom $chatRoom)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChatRoom  $chatRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChatRoom  $chatRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChatRoom  $chatRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatRoom $chatRoom)
    {
        //
    }
    
    public function msgshow($id)
    {
        $userId = Auth::id();
        $messages = ChatRoom::where (function($query) use ($userId, $id){
            $query->where('sender_id', $userId)
            ->where('receiver_id', $id);    
        })
        ->orwhere (function($query) use($userId, $id){
            $query->where('sender_id', $id)
            ->where('receiver_id', $userId);
        })        
        ->get();
        
        $users = User::where('id', '!=', Auth::id())->get();
        return view('chatroom.index',[ 'messages' => $messages, 'users' => $users ]);
    }

}
