<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // バリデーション
        $this->validateLogin($request);

        // ユーザーの取得
        $user = User::where('email', $request->email)->first();

        // 取得できない場合、パスワードが不一致の場合エラー
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [__('failed')],
            ]);
        }

        // tokenの作成
        $token = $user->createToken('token')->plainTextToken;
        // dd($token);
        return response()->json(['token' => $token, 'user' => $user], 200);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        // オーバーライドして、デバイス名を必須化しています
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }


    /**
     * Handle a logout request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        // tokenの削除
        $user->tokens()->delete();

        // このユーザーの現在のトークンを取り消す
        // $user->currentAccessToken()->delete();

        // $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        // $user->tokens()->where('id', $user->$id)->delete();

        return response()->json(['message' => 'logouted']);
    }
}
