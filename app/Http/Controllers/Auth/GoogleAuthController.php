<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GoogleAuthController extends Controller
{
  public function redirectToGoogle()
  {
    if (config('app.auth_disabled')) {
      // Preview 環境 → 認証スキップ
      Log::info('認証スキップモード: redirectToGoogle は無効');
      return redirect('/'); // フロントに戻すだけ
    }

    Log::info('Redirect URI: ' . config('services.google.redirect'));
    return Socialite::driver('google')->stateless()->redirect();
  }

  public function handleGoogleCallback()
  {
    if (config('app.auth_disabled')) {
      // Preview 環境 → 認証スキップ
      Log::info('認証スキップモード: handleGoogleCallback は無効');
      return redirect('/');
    }

    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::firstOrCreate(
      ['email' => $googleUser->getEmail()],
      [
        'name' => $googleUser->getName(),
        'google_id' => $googleUser->getId(),
      ]
    );

    Auth::login($user, true);
    session(['user_id' => $user->id]);

    Log::info('Google ユーザー取得: ', [$googleUser]);
    Log::info('ログイン後のユーザー: ', [Auth::user()]);
    Log::info('セッションID: ' . session()->getId());

    return redirect(env('FRONTEND_URL', 'http://localhost:5173'));
  }
}
