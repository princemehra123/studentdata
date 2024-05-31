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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile');
            $table->string('photo')->nullable();
            $table->string('parentname')->nullable();
            $table->string('parentmobile')->nullable();
            $table->string('address')->nullable();
            $table->enum('gender',['male','female'])->default('male');
            $table->string('email')->nullable();
            $table->string('refernceby')->nullable();
            $table->date('doj')->nullable();
            $table->date('dob')->nullable();
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
        Schema::dropIfExists('students');
    }
};
