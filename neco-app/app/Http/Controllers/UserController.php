<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function update(Request $request){

        // dd($request -> id);
        // リクエストを検証します。
        $this->validator($request->all())->validate();

        $user = User::find($request -> id);

        $user->name = $request->name;
        $user->introduction = $request->introduction;
        $user->region = $request->region;

        $user->save();

        return json_encode(['user' => $user]);
    }

    public function detail($id){
        $posted_user = User::find($id,['name','region','introduction']);

        return json_encode(['postedUser' => $posted_user]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'introduction' => ['string','max:255'],
            'region' => ['required','string']
        ]);
    }
}
