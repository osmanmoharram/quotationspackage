<?php

namespace DOCore\DOQuot\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// use Widget;

class DOQuotServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/Routes/admin-routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Http/Routes/front-routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Http/Routes/api-routes.php');

        $this->loadViewsFrom([
            __DIR__ . '/../Resources/views',
        ], 'doquot');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'doquot');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        // app('arrilot.widget-namespaces')->registerNamespace('doquot', '\DOCore\DOQuot\Widgets');

        // Widget::group('dashboard')->position(0)->addWidget('doquot::MainWidget');

        // if(! Session::has('applied_require_approval_total')){
        //     Session::put([
        //         'applied_require_approval_total' => DB::table('doquot_require_approval_totals')->where('applied', true)->value('value'),
        //     ]);
        // }
    }

    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/config.php', 'doquot');
        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/menu.php', 'menu.admin');
        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/acl.php', 'acl');
    }
}
