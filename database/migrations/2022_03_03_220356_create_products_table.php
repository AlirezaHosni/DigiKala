<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('introduction');
            $table->string('slug')->unique()->nullable();
            $table->string('image');
            $table->decimal('weight', 10, 2);
            $table->decimal('length', 10, 1)->comment('cm units');
            $table->decimal('width', 10, 1)->comment('cm units');
            $table->decimal('height', 10, 1)->comment('cm units');
            $table->decimal('price', 20, 3);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('marketable')->default(1)->comment('1 => marketable, 0 => is not marketable');
            $table->string('tags');
            $table->tinyInteger('sold_number')->default(0);
            $table->tinyInteger('frozens_number')->default(0);
            $table->tinyInteger('marketable_number')->default(0);
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->nullable()->constrained('product_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('published_at');
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
        Schema::dropIfExists('products');
    }
}
