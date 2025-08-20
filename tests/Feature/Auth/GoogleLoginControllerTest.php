<?php

namespace Tests\Feature\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;
use Mockery;

class GoogleLoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function google連携画面にリダイレクトする()
    {
        // Socialiteのモック
        $driver = Mockery::mock(\Laravel\Socialite\Contracts\Provider::class);
        $driver->shouldReceive('stateless')->andReturnSelf();
        $driver->shouldReceive('redirect')
               ->andReturn(redirect('http://localhost:8080/auth/google/callback'));

        Socialite::shouldReceive('driver')
                 ->with('google')
                 ->andReturn($driver);

        $this->get('/api/auth/redirect/google')
            ->assertStatus(302)
            ->assertRedirect('http://localhost:8080/auth/google/callback');
    }

    /** @test */
    public function googleアカウント情報をユーザー登録する()
    {
        $socialiteUser = Mockery::mock(\Laravel\Socialite\Contracts\User::class);
        $socialiteUser->shouldReceive('getId')->andReturn('123456');
        $socialiteUser->shouldReceive('getName')->andReturn('Test User');
        $socialiteUser->shouldReceive('getEmail')->andReturn('test@example.com');

        $driver = Mockery::mock(\Laravel\Socialite\Contracts\Provider::class);
        $driver->shouldReceive('stateless')->andReturnSelf();
        $driver->shouldReceive('user')->andReturn($socialiteUser);

        Socialite::shouldReceive('driver')
                 ->with('google')
                 ->andReturn($driver);

        $this->get('/api/auth/callback/google')
            ->assertStatus(302)
            ->assertRedirect('http://localhost:8000');

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);
    }
}
