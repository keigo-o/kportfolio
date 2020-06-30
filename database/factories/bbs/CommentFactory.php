<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DbModels\bbs\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => "コメントです。テキストテキストテキストテキストテキストテキスト。\nテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。",
    ];
});
