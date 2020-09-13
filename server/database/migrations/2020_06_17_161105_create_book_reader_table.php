<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookReaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_reader', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reader_id');
            $table->unsignedBigInteger('book_id');

            $table->foreign('reader_id')->references('id')->on('readers')->onDelete('cascade');;
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');;

            $table->date('estimated_date');
            $table->date('return_date')->nullable();
            $table->string('status')->default('Ativo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_reader');
    }
}
