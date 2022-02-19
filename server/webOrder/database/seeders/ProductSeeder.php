<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = "products";

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
            for($i = 1;$i<10; $i++){
                $array = array(
                    [
                    'id' => $i,
                    'shop_id' => "1",
                    'name' => "テスト商品{$i}",
                    'price' => '1000',
                    ]
                );
                $shopArray = array_merge($shopArray,$array);
            }
        return $shopArray;
    }
}