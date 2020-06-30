<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class RegisteredMail extends Mailable
{
    /**
     *  ユーザインスタンス.
     *
     *  @var User
     */
    public $user;

    /**
     * 新しいメッセージインスタンスの生成.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('KO-portfolio.site　ユーザー登録完了のお知らせ')
            ->view('portfolio.emails.registered');
    }
}
