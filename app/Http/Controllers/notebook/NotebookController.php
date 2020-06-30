<?php

namespace App\Http\Controllers\notebook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\DbModels\notebook\NotebookInput;
use App\Http\Requests\notebook\ScheduleInputRequest;

/**
* カレンダーコントローラークラス
*/
class NotebookController extends Controller
{
    /**
     * カレンダーの表示
     *
     * @param リクエスト
     */
    public function index(Request $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // 開始時間を昇順にユーザーのカレンダー情報を取得
        $list = NotebookInput::where('users_id', Auth::id())->orderBy('start_time', 'asc')->get();

        // NotebookCalendarクラスのコンストラクタにカレンダー情報を設定
        $cal = new NotebookCalendar($list);

        // カレンダーの表示内容を作成するメソッドを実行してヒアドキュメントで生成したhtmlを受け取る
        // 　※初回の引数はnullのため、NotebookCalendar.phpにてシステム日付が適用される
        // 　※前月、翌月などの遷移時に引数に $request->month, $request->year が適用される
        $tag = $cal->showCalendarTag($request->month, $request->year);

        // カレンダーのhtml情報、ユーザー情報、カレンダー情報をパラメータとして渡して
        // カレンダーを表示する画面へ遷移する
        return view('notebook.index', ['cal_tag'=>$tag, 'user'=>$user, 'list'=>$list]);
    }

    /**
     * 予定入力画面の表示
     */
    public function add(Request $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // ログインユーザーIDのカレンダー情報を取得
        $list = NotebookInput::where('users_id', Auth::id())->get();

        // 今日の日付を取得・フォーマット後に変数設定
        $today = date("Y-m-d"); // （例）2001-03-10

        // HTTPリクエストインスタンスを取得
        $year = $request->input('year');
        $month = $request->input('month');
        $day = $request->input('day');

        // カレンダーの日付をクリックして該当日の入力画面に遷移するための指定日変数を設定
        //年月日のクエリパラメータをdate型にして指定日を取得
        $designated_date = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));

        // ユーザー情報、今日の日付、カレンダークリックした日付、ユーザーID毎のカレンダー情報、変数$dayをパラメータとして渡して
        // 予定を入力する画面へ遷移する
        return view('notebook.input', ['user'=>$user, 'today'=>$today, 'designated_date'=>$designated_date, 'list'=>$list])->with('day', $day);
    }

    /**
     * 入力内容の作成
     *
     * @todo 連番 > 100 になったらアラートを返して登録不可にする。
     */
    public function create(ScheduleInputRequest $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // 手帳モデルをインスタンス化
        $notes = new NotebookInput;

        // 入力したフォーム情報を取得
        $form = $request->all();

        // フォームと編集対象（テーブル情報）の開始日付が不一致の場合の処理
        if ($form['start_day'] !== $notes['start_day']) {

            // 変更した開始日付の「日付連番max値（テーブル情報）」を取得
            $seri_num_colum = NotebookInput::where('users_id', Auth::id())->where('start_day', $form['start_day'])->orderBy('serialnum', 'desc')->first();
            $seri_num = $seri_num_colum['serialnum'];
            (int) $seri_num;

            // もし取得した「日付連番max値」が空なら「1」を代入
            if ($seri_num == "") {
                $seri_num = 1;

                // そうでなければ、取得した「日付連番max値」に+1する
            } else {
                $seri_num++;
            }
            // フォームの連番に「日付連番max値」を代入する
            $form['serialnum'] = $seri_num;
        }

        // フォーム情報からトークン情報を削除
        unset($form['_token']);

        // テーブル情報にフォームの情報を上書きして保存
        $notes->fill($form)->save();

        // ユーザー情報をパラメータに渡して、カレンダー表示画面へリダイレクトで遷移する
        return redirect()->action('notebook\NotebookController@index', ['user' => $user])->with('flash_message', '新しい予定を登録しました');
    }


    /**
     * スケジュール一覧の表示
     *
     * @todo 当月のみ表示、各月のタグ作成（カレンダーと類似した表現とする）
     *
     * @param リクエスト
     */
    public function show(Request $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // NotebookController@eachMonthShowからリダイレクト時に渡されたパラメータ
        // selectオプションで選択した年の値（例）2030
        $selectYear = $request->selectYear;
        // selectオプションで選択した月の値（例）11
        $selectMonth = $request->selectMonth;
        // $selectYear + "-" + $selectMonth（例）2030-11
        $kikan = $request->kikan;

        // 今月の値（例）2020-04
        $nen = date("Y");
        $tuki = date("m");

        // 過去10年を取得
        $pastShowYear = $nen - 10;

        // 未来10年を取得
        $futureShowYear = $nen + 10;

        // 選択する年月の月を配列として保存
        $showMonth = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        // optionタグでプルダウンメニューに表示する月を配列として保存
        $optionMonth = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

        // メニューから一覧に遷移した場合の当月の予定一覧を一時的に格納する変数（Ａ）
        $kongetuLists= null;

        // selectメニューから一覧に遷移した場合の指定月の予定一覧を一時的に格納する変数（Ｂ）
        $kikanLists = null;

        // show.blade.phpの一覧表示に渡すため、上記（Ａ）または（Ｂ）の一覧データを格納する変数
        $lists = null;

        // $kikan（selectメニュー）が空の場合
        if(empty($kikan)){
            // 当月分を対象に開始日付・開始時間を昇順にてユーザーのカレンダー情報を取得
            $kongetuLists = NotebookInput::where('users_id', Auth::id())
            ->where('start_day', 'like', $nen . "-" . $tuki . '%')
            ->orderBy('start_day', 'asc')
            ->orderBy('start_time', 'asc')
            ->paginate(25);
            $lists = $kongetuLists;

        // $kikan（selectメニュー）が空ではない場合
        }else{
            // 指定年月分を対象に開始日付・開始時間を昇順にてユーザーのカレンダー情報を取得
            $kikanLists = NotebookInput::where('users_id', Auth::id())
            ->where('start_day', 'like', $kikan . '%')
            ->orderBy('start_day', 'asc')
            ->orderBy('start_time', 'asc')
            ->paginate(25);
            $lists = $kikanLists;
            $tuki = null;// 全月検索の挙動（正しくは全月の表示）を正しくするためにnullを代入
        }

        // ユーザー情報、スケジュール情報、selectオプション情報、今月情報をパラメータとして渡して
        // スケジュール一覧を表示する画面へ遷移する
        return view('notebook.show', compact('user', 'lists', 'selectYear', 'selectMonth', 'nen', 'tuki', 'pastShowYear', 'futureShowYear', 'showMonth','optionMonth'));
    }

    /**
     * スケジュール一覧を年月毎に再表示する．
     */
    public function eachMonthShow(Request $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // 入力したフォーム情報（年月）を取得
        $form = $request->all();

        // 入力フォーム「年」の値を取得
        $selectYear = $form['year'];
        // 入力フォーム「月」の値を取得
        $selectMonth = $form['month'];

        // $len = strlen($selectMonth);
        // if($len < 2){
        //     $selectMonth = "0" . $selectMonth;
        // }
        // NotebookController@showへ渡すselectメニューの値を取得
        $kikan = $selectYear . "-" . $selectMonth;

        return redirect()->action('notebook\NotebookController@show',  compact('user', 'kikan', 'selectYear', 'selectMonth'));
    }

    /**
     * 予定編集画面の表示
     *
     * @param int $input_id
     */
    public function edit($input_id)
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // 引数の予定入力番号をもとに編集対象の入力情報を取得
        $input_info = NotebookInput::where('users_id', $user->id)->where('input_id', $input_id)->get();

        // 入力情報、ユーザー情報をパラメータとして渡して編集画面へ遷移する
        return view('notebook.edit', compact('input_info', 'user'));
    }

    /**
     * 編集内容の更新
     *
     * @param フォームリクエスト
     */
    public function update(ScheduleInputRequest $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // テーブルから変更対象の入力情報を取得
        $notes = NotebookInput::find($request->input_id);

        // フォームに入力された情報を全て取得
        $form = $request->all();

        // フォームの終日チェックが未チェックの場合は
        // 取得した予定入力情報の終日の値をnullにする
        if(!isset($form['all_day'])){
            $notes['all_day'] = null;

        // フォームの終日チェックがありの場合は
        // 取得した予定入力情報の開始・終了時間の値をnullにする
        }elseif(1 == $form['all_day']){
            $notes['start_time'] = null;
            $notes['end_time'] = null;
        }

        // フォームの管理選択で、プロジェクト管理以外を選択した場合は
        // 取得した予定入力情報のプロジェクト名の値をnullにする
        if(1 == $form['select'] || 2 == $form['select'] || 3 == $form['select']){
            $notes['project'] = null;
        }

        // フォームと編集対象（テーブル情報）の開始日付が不一致の場合の処理
        if($form['start_day'] !== $notes['start_day']){

            // 変更した開始日付の「日付連番max値（テーブル情報）」を取得
            $seri_num_colum = NotebookInput::where('users_id', Auth::id())->where('start_day', $form['start_day'])->orderBy('serialnum', 'desc')->first();
            $seri_num = $seri_num_colum['serialnum'];
            (int) $seri_num;

            // もし取得した「日付連番max値」が空なら「1」を代入
            if ($seri_num == "") {
                $seri_num = 1;

            // そうでなければ、取得した「日付連番max値」に+1する
            } else {
                $seri_num++;
            }
            // フォームの連番に「日付連番max値」を代入する
            $form['serialnum'] = $seri_num;
        }

        // フォーム情報からトークン情報を削除
        unset($form['_token']);

        // テーブル情報にフォームの情報を上書きして保存
        $notes->fill($form)->save();

        // ユーザー情報をパラメータに渡して、カレンダー表示メソッドへリダイレクト
        return redirect()->action('notebook\NotebookController@index', ['user' => $user])->with('flash_message', '予定を更新しました');
    }

    /**
     * 予定を削除する画面を表示
     *
     * @param int $input_id
     */
    public function delete($input_id)
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // テーブルから削除対象の入力情報を取得してフォームに設定
        $form = NotebookInput::where('users_id', $user->id)->where('input_id', $input_id)->get();

        // 削除対象のフォーム情報、ユーザー情報をパラメータとして渡して削除画面に遷移する
        return view('notebook.delete', compact('form', 'user'));
    }

    /**
     * 削除（ソフトデリート）の実行
     *
     * @param リクエスト
     */
    public function remove(Request $request)
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // フォームから送信された入力情報をもとにテーブルから対象データをソフトデリート
        NotebookInput::find($request->input_id)->delete();

        // スケジュール一覧画面へ遷移する
        return redirect('/notebook/show')->with('flash_message', '予定を削除しました');
    }

    /**
     * 使い方の表示（カレンダー表示画面）
     */
    public function showHowToCalendar()
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // ユーザー情報パラメータとして渡して使い方を表示する画面へ遷移する
        return view('notebook.howtocalendar', compact('user'));
    }

        /**
         * 使い方の表示（予定入力画面）
         */
        public function showHowToInput()
        {
            // ユーザー情報の取得
            $user = Auth::user();

            // ユーザー情報パラメータとして渡して使い方を表示する画面へ遷移する
            return view('notebook.howtoinput', compact('user'));
        }

    /**
     * 使い方の表示（スケジュール一覧画面）
     */
    public function showHowToScheduleList()
    {
        // ユーザー情報の取得
        $user = Auth::user();

        // ユーザー情報パラメータとして渡して使い方を表示する画面へ遷移する
        return view('notebook.howtoschedulelist', compact('user'));
    }

    /**
     * ログアウト処理
     */
    public function logout()
    {
        // ログアウト
        Auth::logout();

        // プロフィール画面へ遷移する
        return redirect('/')->with('flash_message', 'ログアウトしました');
    }
}
