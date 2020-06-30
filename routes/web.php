<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Auth
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// ログアウトアクセス対応
Route::get('/logout', 'notebook\NotebookController@logout')->name('logout');

/**
 * ユーザー認証登録完了時のメール送信
 * 参考サイト：https://php-junkie.net/framework/laravel/laravel-regsitered-mail-1/
 */

/**
 * ポートフォリオ
 */
Route::get('/', function () {
    return view('portfolio.portfolio_top'); // 本番用
})->name('portfolio');


/**
 * 機能説明
 */
    Route::get('/functiondescription', 'FunctionDescription\FunctionDescriptionController@index')->name('functiondescription.index');


/**
 * プロフィール
 */
    Route::get('/profile', 'profile\ProfileController@index')->name('profile.index');


/**
 * お問い合わせフォーム　参考サイト　https: //into-the-program.com/laravel-create-contact-form/
 */
//入力ページ
Route::group(['middleware' => 'auth'], function(){
    Route::get('/contact', 'contact\ContactController@index')->name('contact.index');
    //確認ページ
    Route::post('/contact/confirm', 'contact\ContactController@confirm')->name('contact.confirm');
    //送信完了ページ
    Route::post('/contact/thanks', 'contact\ContactController@send')->name('contact.send');
});

/**
 * 行動管理ビジネス手帳サイト
 *
 */
Route::group(['middleware' => 'auth'], function(){
    //ここでルート定義
    Route::get('notebook', 'notebook\NotebookController@index')->name('notebook');
    Route::get('notebook/input', 'notebook\NotebookController@add')->name('notebook.input');
    Route::post('notebook/input', 'notebook\NotebookController@create');
    Route::get('notebook/show', 'notebook\NotebookController@show')->name('notebook.show');
    Route::get('notebook/howtocalendar', 'notebook\NotebookController@showHowToCalendar')->name('notebook.howtocalendar');
    Route::get('notebook/howtoinput', 'notebook\NotebookController@showHowToInput')->name('notebook.howtoinput');
    Route::get('notebook/howtoschedulelist', 'notebook\NotebookController@showHowToScheduleList')->name('notebook.howtoschedulelist');
    Route::post('notebook/show', 'notebook\NotebookController@eachMonthShow');
    Route::get('notebook/{id}/edit', 'notebook\NotebookController@edit')->name('notebook.edit')->where('input_id', '(.*)');
    Route::post('notebook/edit', 'notebook\NotebookController@update');
    Route::get('notebook/{id}/delete', 'notebook\NotebookController@delete')->name('notebook.delete')->where('input_id', '(.*)');
    Route::post('notebook/delete', 'notebook\NotebookController@remove');

});

// laravelソーシャライト対象
Route::get('/auth/google', 'OAuthLoginController@getAuth')->name('togoogle');
Route::get('/auth/callback/google', 'OAuthLoginController@authCallback');

// LINEログイン
Route::get('/toline', 'OAuthLoginController@lineLogin')->name('toline');
Route::get('/auth/line', 'OAuthLoginController@getAuth');
Route::get('/auth/callback/line', 'OAuthLoginController@authCallback');


/**
 * Image_upload　参考サイトhttps: //php-junkie.net/framework/laravel/upload_image/
 */
Route::group(['middleware' => 'auth'], function(){
    //ここでルート定義
    Route::get('/image_upload', 'image_upload\ImageUploadController@index')->name('image_upload');
    Route::post('/image_upload', 'image_upload\ImageUploadController@store');
});

/**
 * 掲示板作成 Auth化
 */
Route::group(['middleware' => 'auth'], function(){
    Route::get('bbs', 'bbs\PostsController@index')->name('top');
    Route::resource('posts', 'bbs\PostsController', ['only' => ['create', 'store']]);
    Route::resource('posts', 'bbs\PostsController', ['only' => ['create', 'store', 'show']]);
    Route::resource('comments', 'bbs\CommentsController', ['only' => ['store']]);
    Route::resource('posts', 'bbs\PostsController', ['only' => ['create', 'store', 'show', 'edit', 'update']]);
    Route::resource('posts', 'bbs\PostsController', ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
});


/**
 * エラーページの表示（HTTPステータスコードを引数に、該当エラーページを表示）
 * URLにHTTPステータスコード（{code}の部分）を含め、それを引き数にabort()メソッドでエラーを発生させている。
 * （例）ドメイン/error/404　でアクセスすると404ページが表示される。
 */
Route::get('error/{code}', function ($code) {
    abort($code);
});


/**
 * laravel Excel使用.
 *
 * エクセルのエクスポートとインポート
 */
// 祝日情報　内閣府からcsvデータをダウンロード　/holidayimportで画面遷移
Route::get('/holidayimport', 'notebook\PublicHolidaysController@index')->name('holidays.index');
Route::post('/holidayimport', 'notebook\PublicHolidaysController@store');