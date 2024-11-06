<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('childrens', function (Blueprint $table) {
            $table->id();
            $table->string('child_name');
            $table->integer('age');
            $table->dateTime('date_of_birth');
            $table->string('gender');
            $table->longText('address');
            $table->string('city');
            $table->integer('grade');
            $table->string('school');
            $table->string('program')->nullable();
            $table->foreignId('personal_details_id')->constrained('personal__details');
            $table->foreignId('guardian_id')->constrained('guardians');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('childrens');
    }
};
