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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users');
            $table->foreignId('examination_id')->constrained()->onDelete('cascade');
            $table->date('issue_date');
            $table->boolean('has_insurance')->default(false);
            $table->unsignedBigInteger('total_amount')->default(0);
            $table->unsignedBigInteger('insurance_amount')->default(0);
            $table->unsignedBigInteger('final_amount')->default(0);
            $table->enum('status', ['pending', 'dispensed', 'canceled'])->default('pending');
            $table->foreignId('pharmacist_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
