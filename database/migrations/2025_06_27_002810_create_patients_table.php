<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('national_id', 12)->unique();
            $table->string('name', 100);
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('insurance_number', 20)->nullable()->unique();
            $table->date('insurance_expiry_date')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
