<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cat;
use App\Message;
use App\MessageRoom;
use Illuminate\Support\Facades\Validator;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function fetchMessages($user_id_1, $user_id_2)
    {
        //メッセージルームがあるか確認
        $message = Message::where(function ($message) use ($user_id_1, $user_id_2) {
            $message->where('send_user', $user_id_1)
                ->where('receive_user', $user_id_2);
        })->orWhere(function ($message) use ($user_id_1, $user_id_2) {
            $message->where('send_user', $user_id_2)
                ->where('receive_user', $user_id_1);
        })->get(['message','send_user']);
        
        return json_encode(['message' => $message]);
    }

    public function sendMessage(Request $request)
    {
        $message = Validator::make($request->all(), [
            'message' => ['required', 'string'],
        ]);

        $send_id = $request->sendId;
        $receive_id = $request->receiveId;

        //メッセージルームがあるか確認
        $message_room = MessageRoom::where(function ($message_room) use ($send_id, $receive_id) {
            $message_room->where('user_id_1', $send_id)
                ->where('user_id_2', $receive_id);
        })->orWhere(function ($message_room) use ($send_id, $receive_id) {
            $message_room->where('user_id_1', $receive_id)
                ->where('user_id_2', $send_id);
        })->exists();

        //メッセージルームがなければ作成する
        if (!$message_room) {
            MessageRoom::create([
                'user_id_1' =>$send_id,
                'user_id_2' => $receive_id,
            ]);
        };

       

        Message::create([
            'message' => $request->message,
            'send_user' => $send_id,
            'receive_user' => $receive_id,
        ]);


        event(new MessageSent($send_id,$receive_id,$request->message));

        return json_encode(['success' => '送信成功しました！']);
    }
}
