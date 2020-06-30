<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SocialiteLineProvider;
use Socialite;

class LineAppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 公式のSocialiteを継承してLINE用の独自ドライバーを作成
        Socialite::extend('line', function ($app) {
            // configディレクトリ内のservices.phpファイルから
            // 連想配列のksy'line'から情報を取得して$configに代入
            $config = $app['config']['services.line'];
            // dd($config);


            return Socialite::buildProvider(\App\Services\SocialiteLineProvider::class, $config);
        });
    }
}
