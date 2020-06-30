<?php

namespace App\Http\Controllers\notebook;

use App\Http\Controllers\Controller;
use App\Imports\PublicHolidayImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Requests\notebook\PublicHolidayImportRequest;

/**
 * 祝日CSVファイルをテーブルにインポートするクラス.
 */
class PublicHolidaysController extends Controller
{
    /**
     * 祝日CSVファイルのインポート画面へ遷移する.
     */
    public function index()
    {
        return view('holidays.index');
    }

    /**
     * 祝日CSVファイルをpublic_holidaysテーブルにインポートする.
     *
     * @param PublicHolidayImportRequest $request
     */
    public function store(PublicHolidayImportRequest $request)
    {
        try {
            $file = $request->file('file');

            Excel::import(new PublicHolidayImport, $file);

            //ファイルを取り込んだらポートフォリオトップ画面へ遷移する
            return view('portfolio.portfolio_top');

        } catch (\Exception $e) {
            echo "エラー：" . $e->getMessage();
            echo "　　ファイルが正しくありません。お手数ですが、ブラウザの戻るボタンで戻ってください。";
            // 動作しなかった
            // return view('holidays.index')->with('flash_message', 'エラー：' . $e->getMessage() .  '　　お手数ですが、ブラウザの戻るボタンで戻ってください。');
        }





    }
}
