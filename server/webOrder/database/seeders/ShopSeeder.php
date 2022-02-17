<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = "shops";

        Schema::disableForeignKeyConstraints(); //外部キー制約を一時的に無くしている

        DB::table($table)->truncate(); //テーブルのデータを削除している。

        DB::table($table)->insert($this->getData());

        DB::table($table)->update([
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        Schema::enableForeignKeyConstraints();

        
    }
    protected function getData()
    {
        $shopArray = array();
            for($i = 1;$i<6; $i++){
                $array = array(
                    [
                    'id' => $i,
                    'name' => "shop{$i}",
                    'business_start_time' => "0{$i}:00",
                    'business_end_time' => "1{$i}:00",
                    'weekly_holiday' => "{$i}",
                    ]
                );
                $shopArray = array_merge($shopArray,$array);
            }
            for($i=6;$i<9; $i++){
                $j = $i-1;
                $array = array(
                    [
                    'id' => $i,
                    'name' => "shop{$i}",
                    'business_start_time' => "0{$i}:00",
                    'business_end_time' => "1{$i}:00",
                    'weekly_holiday' => "{$j},{$i}",
                    ]
                );
                $shopArray = array_merge($shopArray,$array);
            }
        return $shopArray;
    }
}
