<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['Chờ thanh toán', 'Đã thanh toán', 'Đã hủy'])
                  ->default('Chờ thanh toán')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'paid', 'cancelled'])
                  ->default('pending')
                  ->change();
        });
    }
};
