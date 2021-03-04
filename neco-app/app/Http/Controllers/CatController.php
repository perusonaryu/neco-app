<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Cat;
use Illuminate\Support\Facades\Storage;

class CatController extends Controller
{
    public function register(Request $request){

        $this->validator($request->all())->validate();

        if($request->image){
            $file_name = $request->userId.'-'.$request->image->getClientOriginalName();

            $request->image->storeAs('public/catImages',$file_name);

            Cat::create([
                'name' => $request->name,
                'age' => $request->age,
                'personality' => $request->personality,
                'gender' => $request->gender,
                'image' => $file_name,
                'user_id' => $request->userId,
            ]);

            return json_encode(['success' => '猫を登録しました!']);
        }
    }

    public function detail($id){
        $cat_data = Cat::where('id',$id)->get();
        return json_encode(['catData' => $cat_data]);
    }

    public function get(){
        $cats =  Cat::get();

        return json_encode(['catsData' => $cats]);
    }

    public function catslistget($id){
        $mycatslist = Cat::where('user_id',$id)->get();

        // dd($mycatslist);
        return json_encode(['myCatsList' => $mycatslist]);
    }

    public function edit($id){
        $cat_data = Cat::where('id',$id)->get();

        return json_encode(['catData'=>$cat_data]);
    }

    public function update(Request $request){
        $this->updatevalidator($request->all())->validate();
        $cat = Cat::find($request->id);
        $cat->name = $request->name;
        $cat->age = $request->age;
        $cat->personality = $request->personality;
        if(!is_string($request->image)){
            

            $pathdel = public_path().'/storage/catImages/'.$cat->image;
            \File::delete($pathdel);

            $file_name = $cat->user_id.'-'.$request->image->getClientOriginalName();
            $request->image->storeAs('public/catImages',$file_name);
            $cat->image = $file_name;
        }

        $cat->save();

        return json_encode(['catData' => $cat]);

    }


    //県名での検索
    public function search(Request $request){
        $searched_cats_data = Cat::select('cats.*')->join('users','cats.user_id', '=','users.id')->where('region','like', '%'.$request[0].'%')->get();

        return json_encode(['searchedCatsData' => $searched_cats_data]);
        dd($search_cats_data);
    }

    //猫削除
    public function delete($cat_id){
        $cat_data = Cat::find($cat_id);
        $pathdel = public_path().'/storage/catImages/'.$cat_data->image;
        \File::delete($pathdel);

        $cat_data->delete();

        return json_encode(['delete' => '削除成功しました！']);
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

    protected function updatevalidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['string','max:255'],
            'personality' => ['required','string'],
            'image' => ['required'],
        ]);
    }
}
