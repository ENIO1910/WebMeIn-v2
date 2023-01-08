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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('number',100);
            $table->string('name',500);
            $table->string('description',1500);
            $table->string('file_path', 300)->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('lessons');
    }
};
