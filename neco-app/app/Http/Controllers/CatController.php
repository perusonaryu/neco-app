<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Cat;

class CatController extends Controller
{
    public function register(Request $request){
        // dd($request->userId);

        $this->validator($request->all())->validate();

        if($request->image){
            $file_name = $request->userId.'-'.$request->image->getClientOriginalName();

            $request->image->storeAs('public/catImages',$file_name);

            Cat::create([
                'name' => $request->name,
                'age' => $request->age,
                'personality' => $request->personality,
                'image' => $file_name,
                'user_id' => $request->userId,
            ]);
        }
    }

    public function catslistget($id){
        $mycatslist = Cat::where('user_id',$id)->get();

        // dd($mycatslist);
        return json_encode(['myCatsList' => $mycatslist]);
    }



    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['string','max:255'],
            'personality' => ['required','string'],
            'image' => ['required','image'],
        ]);
    }
}
