<?php

namespace Tests\Unit\Mail;

use PHPUnit\Framework\TestCase;
use App\Mail\RegisteredMail;
use Illuminate\Support\Facades\Mail;

class RegisteredMailTest extends TestCase
{
    public function testBuild()
    {
        $user = factory(\App\User::class)->make();

        Mail::fake();

        Mail::to($user)
            ->send(new RegisteredMail($user));

        //メールを指定のメールアドレスに送ったことをアサート
        Mail::assertSent(RegisteredMail::class, function ($mail) use ($user) {
            //メールの件名をアサート
            $mail->build();
            $this->assertEquals('KO-portfolio.site　ユーザー登録完了のお知らせ', $mail->subject);

            return $mail->hasTo($user->email);
        });

        //1回だけ送信されたことをアサート
        Mail::assertSent(RegisteredMail::class, 1);
    }
}
