<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * プロフィール画面のコントローラークラス.
 */
class ProfileController extends Controller
{
    /**
     * プロフィール画面に遷移する.
     */
    public function index()
    {
        return view('portfolio.profile.index');
    }
}
