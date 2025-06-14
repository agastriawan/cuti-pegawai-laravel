<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('admins');
    }
};