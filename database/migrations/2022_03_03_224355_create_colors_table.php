<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('color_name');
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('price_increase', 10, 1)->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sold_number')->default(0);
            $table->tinyInteger('frozens_number')->default(0);
            $table->tinyInteger('marketable_number')->default(0);
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
        Schema::dropIfExists('colors');
    }
}
