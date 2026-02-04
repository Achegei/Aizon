<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // Add is_active column after is_approved
            if (!Schema::hasColumn('courses', 'is_active')) {
                $table->boolean('is_active')
                      ->default(false)
                      ->after('is_approved');
            }
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
