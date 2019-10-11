<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         使用查询构造器



//        $faker = app(Faker\Generator::class);
//
//
//         DB::table('user')->insert([
//          ['name' => $faker->name(), 'money' => 18, 'create_at' => date("Y-m-d H:i:s")],
//        ]);
        for ($i=0;$i<30000000;$i++){
            DB::table('user')->insert([
                'name' => Str::random(10),
                'create_at' => now(),
                'money'=>rand(10,1000000000),
            ]);

        }


//        factory(App\User::class, 2)->create()->each(function($u) {
//            $u->make());
//        });

    }
}
