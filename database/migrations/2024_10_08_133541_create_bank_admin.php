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
        Schema::create('bank_admin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admin');
            $table->string('bank_name');
            $table->string('rekening');
            $table->string('bank_account_number');
            $table->string('bank_account_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_admin');
    }
};
