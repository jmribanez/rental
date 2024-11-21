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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id');
            $table->foreignId('user_id');
            $table->date('date_contract');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('invoice_day');
            $table->double('amount_security_deposit');
            $table->double('amount_rental');
            $table->string('agreed_payment_mode')->nullable();
            $table->string('scanned_contract_file')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
