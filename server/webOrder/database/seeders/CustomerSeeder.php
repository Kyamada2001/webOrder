<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = "customers";

        Schema::disableForeignKeyConstraints(); //外部キー制約を一時的に無くしている

        DB::table($table)->truncate(); //テーブルのデータを削除している。

        DB::table($table)->insert($this->getData());

        DB::table($table)->update([
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);

        Schema::enableForeignKeyConstraints();

        
    }
    protected function getData()
    {
        $shopArray = array();
            for($i = 1;$i<50; $i++){
                $array = array(
                    [
                    'id' => $i,
                    'username' => "テスト　ユーザー{$i}",
                    'email' => "test{$i}@example.com",
                    'password' => bcrypt('password'),
                    ]
                );
                $shopArray = array_merge($shopArray,$array);
            }
        return $shopArray;
    }
}
