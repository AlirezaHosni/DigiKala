<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->foreignId('parent_id')->constrained('comments');
            $table->foreignId('author_id')->constrained('users');
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');
            $table->tinyInteger('seen')->default(0)->comment('unseen => 0, seen => 1');
            $table->tinyInteger('approved')->default(0)->comment('not approved => 0, approved => 1');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('comments');
    }
}
