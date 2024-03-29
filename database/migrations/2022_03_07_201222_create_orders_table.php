<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('address_object');
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('payment_object');
            $table->tinyInteger('payment_type')->default(0);
            $table->tinyInteger('payment_status')->default(0);
            $table->foreignId('delivery_id')->nullable()->constrained('delivery')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('delivery_object');
            $table->tinyInteger('delivery_type')->default(0);
            $table->decimal('delivery_amount', 20, 3)->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->decimal('order_final_amount', 20, 3)->nullable();
            $table->decimal('order_discount_amount', 20, 3)->nullable();
            $table->foreignId('copan_id')->nullable()->constrained('copans')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('copan_object');
            $table->decimal('order_copan_discount_amount', 20, 3)->nullable();
            $table->foreignId('common_discount_id')->nullable()->constrained('common_discount')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('common_discount_object');
            $table->decimal('order_common_discount_amount', 20, 3)->nullable();
            $table->decimal('order_total_products_discount_amount', 20, 3)->nullable();
            $table->tinyInteger('order_status')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
