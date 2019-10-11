<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CheckArticleData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checkData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '查询重复的爬虫爬取的数据';

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
    {
        //重新排序 索引id 到redis 的有序集合
        $sortCollectionId="sortCollectionid";
//        $idCountNum = Redis::set("idCountNum",1);
//        DB::table('article_list')->where("is_rep","=",0)->orderBy('id')->chunk(100, function ($article_list) use($idCountNum,$sortCollectionId) {
//            foreach($article_list as $article){
//                $idCountNum = Redis::get("idCountNum");
//                Redis::zadd($sortCollectionId,$idCountNum,$article->id);//key score id                 ZADD runoobkey 3 mysql
//
//                Redis::incr("idCountNum");
//
//            }
//        });

//        ZRANGEBYLEX key min max

        $IdCollection=Redis::zRangeByScore('sortCollectionid', 4000, 4010, ['withscores' => true]);

//        var_dump($IdCollection);
        $IdArray=array();
        foreach($IdCollection as $key =>$value){
//            echo  $key;
            array_push($IdArray,$key);
        }

        $users = DB::table('article_list')
            ->whereIn('id', $IdArray)
            ->get();
        var_dump($users);


        $users = DB::table('article_list')
            ->where('id', ">=",4000)
            ->where("is_rep",0)
            ->limit(10)
            ->get();
        var_dump($users);


    }
}
