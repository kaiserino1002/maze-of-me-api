<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        //
    }

    /**
     * 未認証時の処理をSPA用にカスタム
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // APIリクエストの場合はJSONで返す
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // 通常アクセスはフロントエンドのログイン画面へ
        return redirect(env('FRONTEND_URL', 'http://localhost:8000') . '/login');
    }
}
