<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = "users";

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
        return  array(
            [
            'id' => 1,
            'name' =>"admin",
            'email' => "admin1@example.com",
            'password' => bcrypt('password'),
            ]
        );
    }
}
