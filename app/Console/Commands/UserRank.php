<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;


class UserRank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:userRank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
      $userArray=array();
        ini_set('memory_limit', '2024M');
//        DB::table('user')->where("id", '>', 5009000)->orderBy("id")->chunk(10000, function ($user) use($userArray) {
//
//            var_dump($user);
//
//        });


//        $UserInfoCollect="UserInfoCollect";
//        $idUserCountNum = Redis::set("idUserCountNum",1);
        DB::table('user')->where("id",">",5000000)->orderBy('id')->chunk(10000, function ($user_list) use($userArray) {
            $chunkData=array();

            foreach($user_list as $user){
//                echo  $idUserCountNum = Redis::get("idUserCountNum");
//                echo $user->money.PHP_EOL;
                array_push($chunkData,$user->money);
//                Redis::zadd($UserInfoCollect,$idUserCountNum,$user->id);//key score id                 ZADD runoobkey 3 mysql
////
//                Redis::incr("idUserCountNum");

            }

            $userArrayInfo=(array_slice( self::sort1111($chunkData),0,10));
            var_dump($userArrayInfo);
           array_push($userArray,$userArrayInfo);
            $endData=(array_slice( self::sort1111($userArray),0,10));
            echo PHP_EOL;
            var_dump(
                $endData
            );
            echo PHP_EOL;

        });



        //构造500w不重复数
//        for($i=0;$i<5000000;$i++){
//            $numArr[] = $i;
//        }
////打乱它们
//        shuffle($numArr);
//
////现在我们从里面找到top10最大的数
//        var_dump(time());
//        print_r(array_slice( self::sort1111($numArr),0,10));
//        var_dump(time());


    }

    private  function  sort1111($array){
        $length = count($array);
        $left_array = array();
        $right_array = array();
        if($length <= 1){
            return $array;
        }
        $key = $array[0];
        for($i=1;$i<$length;$i++){
            if($array[$i] > $key){
                $right_array[] = $array[$i];
            }else{
                $left_array[] = $array[$i];
            }
        }
        $left_array = self::sort1111($left_array);
        $right_array = self::sort1111($right_array);
        return array_merge($right_array,array($key),$left_array);
    }
}
