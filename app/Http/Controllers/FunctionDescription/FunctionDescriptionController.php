<?php

namespace App\Http\Controllers\FunctionDescription;

use App\Http\Controllers\Controller;

/**
 * 機能説明画面のコントローラークラス.
 */
class FunctionDescriptionController extends Controller
{
    /**
     * 機能説明画面に遷移する.
     */
    public function index()
    {
        return view('portfolio.function_description.index');
    }
}
