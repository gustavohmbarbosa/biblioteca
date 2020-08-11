<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * Columns:
     * id, name, email, password, phone, gender, year, class, course, registration, status
     */
    public function up()
    {
        Schema::create('readers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->string('gender');
            $table->string('grade');
            $table->string('class');
            $table->unsignedBigInteger('course_id');
            $table->string('registration');
            $table->year('entry_year');
            $table->string('status')->default("Ativo");
            $table->string('image')->nullable();

            $table->timestamps();
            $table->string('slug');

            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('readers');
    }
}
