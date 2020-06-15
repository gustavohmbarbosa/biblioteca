<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('origin');
            $table->decimal('price', 8, 2)->nullable();
            $table->string('isbn');
            $table->text('synopsis')->nullable();
            $table->integer('pages');
            $table->string('language');
            $table->string('observations')->nullable();
            $table->integer('edition');
            $table->date('publication_date');
            $table->string('color');
            $table->integer('cdd');
            $table->string('cape')->nullable();
            $table->string('company');
            $table->string('author');

            $table->timestamps();

            // $table->foreign('author_id')->references('id')->on('author');
            // $table->foreign('company_id')->references('id')->on('company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
