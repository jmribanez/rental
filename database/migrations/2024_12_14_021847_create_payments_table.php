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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->date('date_payment');
            $table->foreignId('contract_id');
            $table->foreignId('user_id');
            $table->double('amount');
            $table->string('or_number');
            $table->date('date_coverage_start');
            $table->date('date_coverage_end');
            $table->string('payment_mode');
            $table->text('notes')->nullable();
            $table->text('check_number')->nullable();
            $table->date('check_date')->nullable();
            $table->text('check_bank')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
