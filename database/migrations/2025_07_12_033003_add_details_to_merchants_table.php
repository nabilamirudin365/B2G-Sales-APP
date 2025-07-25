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
    Schema::table('merchants', function (Blueprint $table) {
        // Tambahkan kolom setelah kolom 'phone'
        $table->string('owner_name')->after('phone');
        $table->string('owner_phone')->after('owner_name');
        $table->text('photo_paths')->nullable()->after('owner_phone'); // Untuk menyimpan path foto sebagai JSON
        $table->unsignedBigInteger('estimated_sales')->default(0)->after('photo_paths');
        $table->text('notes')->nullable()->after('estimated_sales');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('merchants', function (Blueprint $table) {
            //
        });
    }
};
