<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); 
            $table->string('employee_number')->unique(); 
            $table->string('username')->unique(); 
            $table->string('password'); 
            $table->string('first_name'); 
            $table->string('last_name');
            $table->string('email')->nullable(); 
            $table->enum('status', ['active', 'inactive'])->default('active'); // Account status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
