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
            $table->string('pages');
            $table->string('language');
            $table->string('observations')->nullable();
            $table->string('edition');
            $table->year('publication_year');
            $table->string('color');
            $table->string('cdd');
            $table->string('cape')->nullable();

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->timestamps();
            $table->string('slug');
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
