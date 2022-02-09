<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('shops');
        Schema::dropIfExists('products');
        Schema::create('shops', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->time('business_start_time');
            $table->time('business_end_time');
            $table->tinyInteger('weekly_holiday')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->string('name');
            $table->unsignedInteger('price');
            $table->timestamps();

            $table->foreign('shop_id')
                ->references('id')
                ->on('shops')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        Schema::create('customers', function (Blueprint $table) {
            
            $table->id();
            $table->string('user_name');
            $table->string('user_password');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedInteger('total_amount_including_tax');
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        Schema::create('order_details', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->unsignedInteger('product_quantity');
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });

        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('products');
        Schema::dropIfExists('shops');
        
        
        
        
    }
}
