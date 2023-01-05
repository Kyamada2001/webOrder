<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChangeOrdersShopsIdForegin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Schema::disableForeignKeyConstraints(); //外部キー制約を一時的に無くしている

        // Schema::table('orders', function (Blueprint $table) {
        //     $table->foreign('shop_id')
        //         ->references('id')
        //         ->on('shops')
        //         ->cascadeOnDelete() //消さないほうがいい？
        //         ->cascadeOnUpdate()
        //         ->change();
        // });

        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('shop_id')
                ->references('id')
                ->on('customers')
                ->cascadeOnDelete() //消さないほうがいい？
                ->cascadeOnUpdate()
                ->change();
        });
    }
}
