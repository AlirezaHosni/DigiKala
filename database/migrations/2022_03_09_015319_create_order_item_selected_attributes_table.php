<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemSelectedAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_selected_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->nullable()->constrained('order_items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_attribute_id')->nullable()->constrained('category_attributes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_value_id')->nullable()->constrained('category_attributes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('value')->nullable()->comment('for multiple choise items');
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
        Schema::dropIfExists('order_item_selected_attributes');
    }
}
