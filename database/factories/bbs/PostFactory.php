<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DbModels\bbs\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
         'title' => '投稿のタイトル',
        'body' => "本文です。テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。\nテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。",
    ];
});
