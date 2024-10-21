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
        Schema::create('user_wallet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->double('kredit');
            $table->double('debit');
            $table->double('saldo');
            $table->enum('type', ['kredit', 'debit']);
            $table->string('kode_transaksi')->nullable();
            $table->string('kode_bank')->nullable();
            $table->string('rekening')->nullable();
            $table->string('rekening_pengirim')->nullable();
            $table->string('nama')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['pending', 'success', 'failed', 'rejected']);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wallet');
    }
};
