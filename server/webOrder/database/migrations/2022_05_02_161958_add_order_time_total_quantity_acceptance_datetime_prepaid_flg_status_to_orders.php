<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderTimeTotalQuantityAcceptanceDatetimePrepaidFlgStatusToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dateTime('order_time');
            $table->integer('total_quantity');
            $table->integer('total_amount_including_tax')->change();
            $table->renameColumn('total_amount_including_tax', 'total_amount');
            $table->dateTime('acceptance_datetime');
            $table->unsignedTinyInteger('prepaid_flg');
            $table->unsignedTinyInteger('status');
            $table->string('tel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_time');
            $table->dropColumn('total_quantity');
            $table->renameColumn('total_amount', 'total_amount_including_tax');
            $table->unsignedInteger('total_amount_including_tax')->change();
            $table->dropColumn('acceptance_datetime');
            $table->dropColumn('prepaid_flg');
            $table->dropColumn('status');
            $table->dropColumn('tel');
        });
    }
}
