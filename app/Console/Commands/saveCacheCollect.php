<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;


class saveCacheCollect extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:saveCacheCollect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '缓存所有拼音首字母到redis集合中/并优化每天的重复数据';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {       //初始化全部数据进入redis 并修改重复的状态
//       DB::table('article_list')->orderBy('id')->chunk(100, function ($article_list) {
//                foreach($article_list as $article){
//
//                    $isExist=Redis::sismember("UniqueStr:Collection",$article->unique_str);
//                    if (!$isExist){
//                        Redis::sadd("UniqueStr:Collection",$article->unique_str);
//                    }else{
//                        DB::update('update article_list set is_rep = 1 where id = ?', [$article->id]);
//                    }
//
//
//                }
//
//        });

        $today=  date("Y-m-d :00:00:00");
        $tomorrow=date("Y-m-d :00:00:00",strtotime("+1day"));

       DB::table('article_list')->where("create_time",">",$today)->where("create_time","<",$tomorrow)->orderBy('id')->chunk(100, function ($article_list) {
           foreach($article_list as $article){
                    $isExist=Redis::sismember("UniqueStr:Collection",$article->unique_str);
                    if (!$isExist){
                        Redis::sadd("UniqueStr:Collection",$article->unique_str);
                    }else{
                        DB::update('update article_list set is_rep = 1 where id = ?', [$article->id]);
                    }


                }

        });

    }
}
