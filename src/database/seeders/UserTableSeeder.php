<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        // ① sampleユーザーが存在するか確認
        $user = DB::table('users')->where('email', 'sample@example.com')->first();

        if (!$user) {
            // 存在しなければ作成
            $userId = DB::table('users')->insertGetId([
                'name' => 'sample',
                'email' => 'sample@example.com',
                'password' => Hash::make('sample1234')
            ]);
        } else {
            // 既に存在するならそのIDを使う
            $userId = $user->id;
        }

        // ② weight_target を重複させない（updateOrInsert）
        DB::table('weight_target')->updateOrInsert(
            ['user_id' => $userId],
            ['target_weight' => 55.0]
        );

        // ③ weight_logs の初期データを重複させない
        DB::table('weight_logs')->updateOrInsert(
            [
                'user_id' => $userId,
                'date' => '2025-01-15'
            ],
            [
                'weight' => 52.0,
                'calories' => 1200,
                'exercise_time' => '02:20:00'
            ]
        );
    }
}
