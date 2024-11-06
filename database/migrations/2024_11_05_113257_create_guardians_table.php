<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('guardian_name');
            $table->string('contact_number_1');
            $table->string('contact_number_2');
            $table->string('relationship');
            $table->string('region');
            $table->string('connecting_location');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guardians');
    }
};
