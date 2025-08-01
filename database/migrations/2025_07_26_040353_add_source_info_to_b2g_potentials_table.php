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
         Schema::table('b2g_potentials', function (Blueprint $table) {
        $table->string('source_of_info')->nullable()->after('estimated_value');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('b2g_potentials', function (Blueprint $table) {
            //
        });
    }
};
