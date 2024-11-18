<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('child_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('childrens')->onDelete('cascade'); // Foreign key to children
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade'); // Foreign key to programs
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('child_program');
    }
};
