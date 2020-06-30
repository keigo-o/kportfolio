// 手帳入力画面フォームエレメント番号表
// タスク管理          document.forms[0].elements[3]
// 単発予定管理        document.forms[0].elements[4]
// プライベート        document.forms[0].elements[5]
// プロジェクト管理    document.forms[0].elements[6]
// プロジェクト名      document.forms[0].elements[7]
// タイトル入力        document.forms[0].elements[8]
// 開始日付            document.forms[0].elements[9]
// 開始時間            document.forms[0].elements[10]
// 終了日付            document.forms[0].elements[11]
// 終了時間            document.forms[0].elements[12]
// 終日                document.forms[0].elements[13]
// 所要時間
// 30分                document.forms[0].elements[14]
// 60分                document.forms[0].elements[15]
// 90分                document.forms[0].elements[16]
// 120分               document.forms[0].elements[17]
// アラーム            document.forms[0].elements[18]
// 重要度
// 大                  document.forms[0].elements[19]
// 中                  document.forms[0].elements[20]
// 小                  document.forms[0].elements[21]
// 予定内容            document.forms[0].elements[22]
// メモ                document.forms[0].elements[23]

// プロジェクト名の入力を制限する
function changeProjectDisabled() {
    if (document.forms[0].elements[3].checked) {
        document.forms[0].elements[7].value = "";
        document.forms[0].elements[7].disabled = true;
    } else if (document.forms[0].elements[4].checked) {
        document.forms[0].elements[7].value = "";
        document.forms[0].elements[7].disabled = true;
    } else if (document.forms[0].elements[5].checked) {
        document.forms[0].elements[7].value = "";
        document.forms[0].elements[7].disabled = true;
    } else if (document.forms[0].elements[6].checked) {
        document.forms[0].elements[7].disabled = false;
    }
}

// 終日チェックによる入力を制限する（開始時間、終了時間）
function changeAllDayDisabled() {
    if (document.forms[0].elements[13].checked) {
        document.forms[0].elements[10].value = "";
        document.forms[0].elements[12].value = "";
        document.forms[0].elements[10].disabled = true;
        document.forms[0].elements[12].disabled = true;
        document.forms[0].elements[14].disabled = true;
        document.forms[0].elements[15].disabled = true;
        document.forms[0].elements[16].disabled = true;
        document.forms[0].elements[17].disabled = true;
    } else {
        document.forms[0].elements[10].disabled = false;
        document.forms[0].elements[12].disabled = false;
        document.forms[0].elements[14].disabled = false;
        document.forms[0].elements[15].disabled = false;
        document.forms[0].elements[16].disabled = false;
        document.forms[0].elements[17].disabled = false;
    }
}

// 所要時間から終了時間を自動で表示する
function changeEndtime() {
    const AFTER_MINUTES_ELEMENT = 'document.forms[0].elements[13].name'; // 所要時間30分のエレメント
    const SET30 = 30;
    const SET60 = 60;
    const SET90 = 90;
    const SET120 = 120;
    var val = "";

    if (AFTER_MINUTES_ELEMENT == 'end_time') {
        AFTER_MINUTES_ELEMENT = "after_minutes";
        // alert('所要時間のname属性をend_timeからafter_minutesへ変更しまいた');
    }

    var start_time = document.getElementById('start_time').value;
    var hh = start_time.replace(/(\d{2}):(\d{2})/, '$1');
    var mm = start_time.replace(/(\d{2}):(\d{2})/, '$2');
    var q = new Date("1979", "9", "08", hh, mm);

    //ここでラジオボタンにチェックが入っている場所を判定して、所要時間を足している
    // 所要時間30分のラジオボタンがチェックされた場合
    if (document.getElementById('after_minutes30').checked) {
        var t = q.setMinutes(q.getMinutes() + SET30);
    } else if (document.getElementById('after_minutes60').checked) {
        var t = q.setMinutes(q.getMinutes() + SET60);
    } else if (document.getElementById('after_minutes90').checked) {
        var t = q.setMinutes(q.getMinutes() + SET90);
    } else if (document.getElementById('after_minutes120').checked) {
        var t = q.setMinutes(q.getMinutes() + SET120);
    }
    // 終日チェックも解除しておく
    document.forms[0].elements[13].checked = false;
    //上で所要時間を足した結果「t」を引数に新規dateを作成
    var u = new Date(t);
    var v = getStringFromDate(u);
    var w = v.replace(/(.*)(\d{2}):(\d{2}):(\d{2})/, '$2:$3');

    // 以下、開始時間に各所要時間を足して終了時間に画面常時andDB登録準備をする
    // 所要時間30分のラジオボタンがチェックされた場合
    if (document.getElementById('after_minutes30').checked) {

        // 所要時間30分のラジオボタンのvalueに計算済み終了時間（変数w）を代入する
        // これは最終的にDB登録に使用する値となる。【最後の処理】を参照。
        document.getElementById("after_minutes30").value = w;

        // 終了時間のvalueに代入（画面の終了時間表示切替のため）
        document.forms[0].elements[12].value = w;

        // 以下60分、90分、120分がチェックされた場合
    } else if (document.getElementById('after_minutes60').checked) {
        document.getElementById("after_minutes60").value = w;
        document.forms[0].elements[12].value = w;
    } else if (document.getElementById('after_minutes90').checked) {
        document.getElementById("after_minutes90").value = w;
        document.forms[0].elements[12].value = w;
    } else if (document.getElementById('after_minutes120').checked) {
        document.getElementById("after_minutes120").value = w;
        document.forms[0].elements[12].value = w;
    }
    // 【最後の処理】：ラジオボタン「after_minutes」のname属性を「end_time」に変更する。（DB登録するため）
    $('input[name="after_minutes"]').attr('name', 'end_time');
}

//このコードはネットから　0埋めバージョン　https://web.plus-idea.net/on/javascript-date-string-convert/
function getStringFromDate(date) {

    var year_str = date.getFullYear();
    //月だけ+1すること
    var month_str = 1 + date.getMonth();
    var day_str = date.getDate();
    var hour_str = date.getHours();
    var minute_str = date.getMinutes();
    var second_str = date.getSeconds();

    month_str = ('0' + month_str).slice(-2);
    day_str = ('0' + day_str).slice(-2);
    hour_str = ('0' + hour_str).slice(-2);
    minute_str = ('0' + minute_str).slice(-2);
    second_str = ('0' + second_str).slice(-2);

    format_str = 'YYYY-MM-DD hh:mm:ss';
    format_str = format_str.replace(/YYYY/g, year_str);
    format_str = format_str.replace(/MM/g, month_str);
    format_str = format_str.replace(/DD/g, day_str);
    format_str = format_str.replace(/hh/g, hour_str);
    format_str = format_str.replace(/mm/g, minute_str);
    format_str = format_str.replace(/ss/g, second_str);

    return format_str;
};

function endTimeAndAllDayController() {
    document.forms[0].elements[12].value = document.forms[0].elements[10].value;
    document.forms[0].elements[13].checked = false;
}

function AllDayController() {
    document.forms[0].elements[13].checked = false;
}

window.onload = changeProjectDisabled, changeAllDayDisabled, changeEndtime, getStringFromDate, endTimeAndAllDayController, AllDayController;