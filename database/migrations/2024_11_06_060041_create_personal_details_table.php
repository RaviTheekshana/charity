<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('personal__details', function (Blueprint $table) {
            $table->id();
            $table->string('inmate_no');
            $table->string('inmate_name');
            $table->foreignId('prison_id')->constrained('prisons');
            $table->integer('sentence_no');
            $table->dateTime('end_year_sentence');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personal_details');
    }
};
