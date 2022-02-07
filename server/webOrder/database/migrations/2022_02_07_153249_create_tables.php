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

        Schema::create('shops', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->datetime('business_hour');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            
            $table->id();
            $table->unsingedBigInteger('shop_id');
            $table->string('name');
            $table->unsignedInteger('price');
            $table->timestamps();

            $table->foreign('shop_id')
                ->refrences('id')
                ->on('shops')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
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
            $table->unsingedInteger('total_amount_including_tax');
            $table->timestamps();

            $table->foreign('customer_id')
                ->refrences('id')
                ->on('customers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create('order_details', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->unsignedInteger('product_quantity');
            $table->timestamps();

            $table->foreign('order_id')
                ->refrences('id')
                ->on('orders')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('product_id')
                ->refrences('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
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
