<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemSelectedAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_item_selected_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_item_id')->nullable()->constrained('cart_items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_attribute_id')->nullable()->constrained('category_attributes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_value_id')->nullable()->constrained('category_attributes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('value')->nullable();
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
        Schema::dropIfExists('cart_item_selected_attributes');
    }
}
