<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
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
//        DB::listen(function($query) {
//            Log::info(
//                $query->sql,
//                $query->bindings,
//                $query->time
//            );
//        });

        DB::listen(function ($query) {
            $tmp = str_replace('?', '"'.'%s'.'"', $query->sql);
            $qBindings = [];
            foreach ($query->bindings as $key => $value) {
                if (is_numeric($key)) {
                    $qBindings[] = $value;
                } else {
                    $tmp = str_replace(':'.$key, '"'.$value.'"', $tmp);
                }
            }
            $tmp = vsprintf($tmp, $qBindings);
            $tmp = str_replace("\\", "", $tmp);
            Log::info(' execution time: '.$query->time.'ms; '.$tmp."\n\n\t");

        }
        );
    }
}
