<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightLog;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // UserTableSeeder を実行
        $this->call(UserTableSeeder::class);

        // sampleユーザーのIDを取得
        $userId = DB::table('users')->where('email', 'sample@example.com')->value('id');

        // Factoryで作ったログを毎回初期化してから作成
        WeightLog::where('user_id', $userId)->delete();

        WeightLog::factory(35)->create([
            'user_id' => $userId
        ]);
    }
}
