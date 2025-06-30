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
        Schema::create('service_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_request_detail_id')->constrained()->onDelete('cascade');
            $table->text('result_text')->nullable();
            $table->text('result_file')->nullable();
            $table->text('note')->nullable();
            $table->dateTime('completed_at');
            $table->foreignId('performed_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_results');
    }
};
