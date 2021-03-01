<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function register(Request $request)
    {
        // リクエストを検証します。
        $this->validator($request->all())->validate();

        // ユーザーの作成とトークンの作成します
        $data = DB::transaction(function () use ($request) {
            $user = $this->create($request->all());
            $token = $user->createToken($request->device_name ?? 'undefined')->plainTextToken;
            return json_encode(['token' => $token, 'user' => $user]);
        });
        // userとtokenのjsonを返却
        return response($data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'region' => ['required','string'],
            'image' => ['required','image'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if ($data['image']) {
            $file_name = Str::random(20).'-'.$data['image']->getClientOriginalName();
            $data['image']->storeAs('public/userImages',$file_name);

            
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'region' => $data['region'],
                'image' => $file_name,
                
            ]);
        }
    }
}
