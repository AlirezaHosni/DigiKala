<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('product');
            $table->foreignId('amazing_sale_id')->nullable()->nullable()->constrained('amazing_sales')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('amazing_sale_object');
            $table->decimal('amazing_sale_discount_amount', 20, 3)->nullable();
            $table->integer('number')->default(1);
            $table->decimal('final_product_price', 20, 3)->nullable();  
            $table->decimal('final_total_product_price', 20, 3)->nullable()->comment('number * final_total_product_price');
            $table->foreignId('color_id')->nullable()->nullable()->constrained('colors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('guarantee_id')->nullable()->nullable()->constrained('guarantees')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
