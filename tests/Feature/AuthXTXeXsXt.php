<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

class AuthTest extends TestCase
{
    /**
     *  会員登録のテスト
     *
     */
    public function testRegister()
    {
        Event::fake();

        //新規会員情報の送信
        $user = factory(\App\User::class)->make();
        $user = $user->toArray();
        $user['password'] = 'testtest';
        $user['password_confirmation'] = 'testtest';

        $response = $this->post('/register', $user);

        //homeページへのリダイレクトをアサート
        $response->assertRedirect('/');

        //送信したユーザ情報がDBにあることをアサート
        $this->assertDatabaseHas('users', [
            'name' => $user['name'],
            'email' => $user['email'],
        ]);

        //イベントがディスパッチされたことをアサート
        Event::assertDispatched(Registered::class, function ($event) use ($user) {
            return $event->user->email === $user['email'];
        });

        //イベントが1回だけディスパッチされたことをアサート
        Event::assertDispatched(Registered::class, 1);
    }
}
