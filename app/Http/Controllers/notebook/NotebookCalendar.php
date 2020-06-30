<?php

namespace App\Http\Controllers\notebook;

use Illuminate\Support\Str;
use App\DbModels\notebook\PublicHoliday;


/**
 * カレンダーの表示内容生成クラス.
 */
class NotebookCalendar
{
    // html情報保持変数
    private $html;

    // カレンダー情報
    private $lists;

    // 日付跨ぎの予定を格納する多次元配列変数
    protected $showSchejuleData = [];

    protected $nameArray = [];

    protected $cast_time;

    /**
     * コンストラクタ.
     *
     * @param カレンダー情報
     */
    function __construct($lists) {
        $this->lists = $lists;
    }

    /**
     * カレンダータグの生成.
     *
     * @param 変数$m $y
     */
    public function showCalendarTag($m, $y)
    {

        //////////////////////////////////////
        // 当月・前月・翌月の情報を取得
        //////////////////////////////////////
        $year = $y;
        $month = $m;
        //年が空の場合はシステム日付を取得する
        if ($year == null) {
            //システム日付を取得する
            $year = date("Y");
            $month = date("m");
        }
        // 最初の日付の曜日を取得（0 (日曜)から 6 (土曜)）
        $firstWeekDay = date("w", mktime(0, 0, 0, $month, 1, $year)); //1日の曜日（0:日曜日、6:土曜日）
        // 日曜日からカレンダーを表示するため前月の余った日付をループの初期値にする
        $day = 1 - $firstWeekDay;
        // 指定した月の日数を取得
        $lastDay = date("t", mktime(0, 0, 0, $month, 1, $year)); //指定した月の最終日
        //前月の年月を取得
        $prev = strtotime('-1 month', mktime(0, 0, 0, $month, 1, $year));
        $prev_year = date("Y", $prev);
        $prev_month = date("m", $prev);
        //翌月の年月を取得
        $next = strtotime('+1 month', mktime(0, 0, 0, $month, 1, $year));
        $next_year = date("Y", $next);
        $next_month = date("m", $next);
        // カレンダーの曜日の表示配列
        $week = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
        // index   0      1      2      3      4      5      6

        // 今日の年月日を取得
        $today = date("Y-m-d");
        // 祝日テーブルから祝日情報を取得
        $holidays = PublicHoliday::all();

        //////////////////////////////////////
        // カレンダータグの作成
        //////////////////////////////////////

        //////////////////////////////////////
        // カレンダーのベースを作成
        $this->html = <<< EOS
            <div class="calendar-date">
              <div class="calendar-date-main-header">
                <div>
                <h6>
                <a class="" href="/notebook/?year={$prev_year}&month={$prev_month}" role="button">&lt;&lt;前月</a>
                {$year}年{$month}月
                <a class="" href="/notebook/?year={$next_year}&month={$next_month}" role="button">翌月&gt;&gt;</a>
                </h6>
                </div>
                <div>
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link " href="/notebook/?year={$year}&month=1" role="button">1月</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/notebook/?year={$year}&month=2" role="button">2月</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/notebook/?year={$year}&month=3" role="button">3月</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="/notebook/?year={$year}&month=4" role="button">4月</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/notebook/?year={$year}&month=5" role="button">5月</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/notebook/?year={$year}&month=6" role="button">6月</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="/notebook/?year={$year}&month=7" role="button">7月</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/notebook/?year={$year}&month=8" role="button">8月</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/notebook/?year={$year}&month=9" role="button">9月</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="/notebook/?year={$year}&month=10" role="button">10月</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/notebook/?year={$year}&month=11" role="button">11月</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/notebook/?year={$year}&month=12" role="button">12月</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="calendar-main-days">
                <!-- <h1>{$year}年{$month}月</h1> -->
                <table class="table table-bordered calendar-table" id="main-days">
                  <tr class="day_of_week">
                    <th class="sun" scope="col">日</th>
                    <th class="mon" scope="col">月</th>
                    <th class="tue" scope="col">火</th>
                    <th class="wed" scope="col">水</th>
                    <th class="thu" scope="col">木</th>
                    <th class="fri" scope="col">金</th>
                    <th class="sat" scope="col">土</th>
                  </tr>
EOS;

        //////////////////////////////////////
        // カレンダーの内容を作成

        //カレンダーの日付部分を生成する
        while ($day <= $lastDay) {
            $this->html .= "<tr id='days-tr'>";

            //各週を描画するHTMLソースを生成する
            for ($i = 0; $i < 7; $i++) {

                // 先月・翌月の日付の場合
                if ($day <= 0 || $day > $lastDay) {
                    $this->html .= "<td class='none_day'>&nbsp;</td>";

                    ////////////////////////////////////////
                    // ※ここに先月・翌月の表示処理をしているので
                    // 　日を表示したいのなら以降に記述すれば可能

                // 当月の日付の場合
                } else {
                    // 曜日の取得
                    $youbi = date("w", mktime(0, 0, 0, $month, $day, $year));

                    //////////////////////////////////////////////////////////////////////////////////////////
                    // 日付全体をクリックしたい aタグ設定 display: block（なのかな？上手く挙動しなかったけど）
                    // アドレスに日付を入力した時、ありもしない数字（例えば、13月や32日はエラーにしたい）

                    //今日の日付と一致判定をするための判定日付を設定
                    $boolean_today = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));

                    // 判定日付が今日の場合
                    if ($boolean_today == $today) {
                      // 日付のセルclassにtodayを記述する
                      $this->html .= "<td class='today ";
                    }else{
                      $this->html .= "<td class=' ";
                    }
                    // カレンダー情報（祝日や予定など）を表示するターゲット日の変数を設定
                    $target = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));

                    // カレンダーの日付の数字部分のhtmlコードを生成してhtml末尾にコード追加する
                    $this->html .= "td-day'><a href='/notebook/input/?year={$year}&month={$month}&day={$day}' name='' value='' class='day-a " . $week[$youbi] . "'>" . $day . "</a>";

                    // 祝日情報の日付とターゲット日の日付を比較して、該当日に祝日名を表示
                    foreach ($holidays as $holiday){
                      if($holiday->date == $target){
                        $this->html .= '<span class="holiday" name="holiday">' . Str::limit($holiday->name, 20) . '</span><br>';
                      }
                    }

                    // カレンダー情報の日付とターゲット日の日付を比較して、該当日に予定時間とタイトルを表示
                    foreach ($this->lists as $list) {

                            // 日付跨ぎのカレンダー表示のため、日付跨ぎ分のインプットIDを取得
                            // 終了日付と開始日付が同一ではなかった場合
                            if($list->end_day !== $list->start_day){

                              // 多重連想配列の$showSchejuleDataからキーワード'inid'を配列として取得して$nameArrayに代入
                              $this->nameArray = array_column($this->showSchejuleData, 'inid');

                              // 対象インプットID（$list->input_id）が$nameArrayに含まれているかを確認して結果（boolean）を$resultに代入
                              $result = array_search($list->input_id, $this->nameArray);

                                // $resultがfalseの場合
                                if($result === false){

                                  // $showSchejuleDateにインプットID、開始日付、終了日付、予定の件名を追加
                                  $this->showSchejuleData[] = ['inid'=>$list->input_id, 'stday'=>$list->start_day, 'enday'=>$list->end_day, 'tit'=>$list->title];
                                }
                            }

                            // カレンダー情報の日付とターゲット日の日付が同じ場合
                            if ($list->start_day == $target) {

                                // 開始時間を文字列化
                                $this->cast_time = (string)$list->start_time;

                                // 文字列化した開始時間の文字の長さを取得
                                $len = strlen($this->cast_time);

                                // 文字列の長さが5バイトより大きい場合
                                if($len > 5){

                                    // 開始時間の末尾から「:00」を削除
                                    // myaqlから取得した時間が（例）「11:22:33」と表示されたので「11:22」に置き換える
                                    $this->cast_time = preg_replace('/:\d{2}$/', '', $this->cast_time);
                                }

                                // 日付とタイトル（両方合わせて20バイトまで）を画面に表示。残りは「...」と表示する。
                                $this->html .= '<a href="/notebook/' . $list->input_id . '/edit" class="schedule"><span class="importance_mark' . $list->importance . '">' . Str::limit($this->cast_time . ' ' . $list->title ,20) . '</span></a>';
                            }

                            foreach($this->showSchejuleData as $data){
                              if($list->input_id === $data['inid'] && $target > $data['stday'] && $target <= $data['enday']){
                                $this->html .= '<a href="/notebook/' . $list->input_id . '/edit" class="schedule"><span class="duble_schedule">' . Str::limit('…' . $list->title ,20) . '</span></a>';
                                // dump($day);
                                // dump($list->input_id);
                              }
                            }
                    }
                    $this->html .= "</td>";
                }
                $day++;
            }
            $this->html .= "</tr>";
        }
        $this->html .= '</table></div></div></div>';

        // dump($this->nameArray);
        // dump($this->showSchejuleData);

        return $this->html;
    }
}