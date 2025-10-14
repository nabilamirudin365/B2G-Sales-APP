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
    Schema::table('orders', function (Blueprint $table) {
        // Tambahkan kolom merchant_id setelah user_id
        // constrained() akan otomatis merujuk ke primary key di tabel 'merchants'
        $table->foreignId('merchant_id')->after('user_id')->constrained()->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        // Hapus foreign key dan kolom jika migrasi di-rollback
        $table->dropForeign(['merchant_id']);
        $table->dropColumn('merchant_id');
    });
}
};
