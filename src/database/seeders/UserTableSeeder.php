<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=[
            'name'=>'sample',
            'email'=>'hoge@example.com',
            'password'=>Hash::make('hoge1234')
        ];
        DB::table('users')->insert($user);
        $weight_target=[
            'user_id'=>1,
            'target_weight'=>55.0
        ];
        DB::table('weight_target')->insert($weight_target);
        $weight_log=[
            'user_id'=>1,
            'weight'=>52.0,
            'calories'=>1200,
            'exercise_time'=>'02:20:00',
            'date'=>'2025-01-15'
        ];
        DB::table('weight_logs')->insert($weight_log);
    }
}