<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessageRoom;
use Auth;

class MessageRoomController extends Controller
{
    public function index($id){
        //すでにあるメッセージルーム取得
        // $message_room = MessageRoom::where(function ($message_room) use ($send_id, $receive_id) {
        //     $message_room->where('user_id_1', $send_id)
        //         ->where('user_id_2', $receive_id);
        // })->orWhere(function ($message_room) use ($send_id, $receive_id) {
        //     $message_room->where('user_id_1', $receive_id)
        //         ->where('user_id_2', $send_id);
        // })->get();

        $message_room = MessageRoom::where('user_id_1',$id)->orWhere('user_id_2',$id)->get();

        return json_encode(['chatList' => $message_room]);
    }
}
