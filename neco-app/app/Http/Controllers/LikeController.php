<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function check(Request $request){
        $check = Like::where('user_id',$request->user_id)->where('cat_id',$request->cat_id)->exists();
        return json_encode(['check' => $check]);
    }

    public function like(Request $request){
        Like::create([
            'user_id' => $request->user_id,
            'cat_id' => $request->cat_id,
        ]);

    }

    public function unlike(Request $request){
        $like = Like::where('user_id',$request->user_id)->where('cat_id',$request->cat_id)->first();
        $like->delete();
    }
}
