<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicMailFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_mail_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('public_mail_id')->nullable()->constrained('public_mail')->onDelete('cascade')->onUpdate('cascade');
            $table->text('file-path');
            $table->bigInteger('file-size');
            $table->text('file-type');
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
        Schema::dropIfExists('public_mail_files');
    }
}
