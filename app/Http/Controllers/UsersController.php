<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Requests\excel\UsersImportRequest;

class UsersController extends Controller
{
    /**
     * ユーザー情報をexcel csvファイルにエクスポート.
     */
    public function export()
    {
        // return (new UsersExport)->download('test.csv');//Exportableトレイトを使う

        return Excel::download(new UsersExport, 'users.csv');//下と同じ
        // return Excel::download(new UsersExport, 'users.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function  index()
    {
        return view('excel.index');
    }

    /**
     * ユーザー情報（excel csv）をusersテーブルにインポート.
     *
     * @param UsersImportRequest $request
     */
    public function store(UsersImportRequest $request)
    {
        $file = $request->file('file');

        Excel::import(new UsersImport, $file);

        return view('portfolio.portfolio_top');

    }


}
