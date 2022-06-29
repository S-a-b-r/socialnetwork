<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('reader_id');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('reader_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_lists', function (Blueprint $table){
            $table->dropForeign(['author_id']);
            $table->dropForeign(['reader_id']);
        });
        Schema::dropIfExists('access_lists');
    }
};
