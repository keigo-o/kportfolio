<?php

namespace App\Http\Controllers\bbs;

use Illuminate\Http\Request;
use App\DbModels\bbs\Comment;
use App\DbModels\bbs\Post;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|max:2000',
        ]);

        $post = Post::findOrFail($params['post_id']);
        $post->comments()->create($params);

        $hoge = [1,2,3];
        $i = $hoge;

        return redirect()->route('posts.show', ['post' => $post]);
    }
}
