<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
      public function redirectToGoogle()
    {
        \Log::info('Redirect URI: ' . config('services.google.redirect'));
        return Socialite::driver('google')->stateless()->redirect();
    }

    // Googleからのコールバック
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // ユーザー登録 or ログイン
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                // 必要なら追加カラムもここに
            ]
        );

        Auth::login($user, true);
        session(['user_id' => $user->id]);

        \Log::info('Google ユーザー取得: ', [$googleUser]);
        \Log::info('ログイン後のユーザー: ', [Auth::user()]);
        \Log::info('セッションID: ' . session()->getId());


        // SPAトップへリダイレクト
        return redirect(env('FRONTEND_URL', 'http://localhost:8000'));
    }
}
