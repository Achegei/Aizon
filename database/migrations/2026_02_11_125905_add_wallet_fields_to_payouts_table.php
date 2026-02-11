<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payouts', function (Blueprint $table) {
            $table->enum('type', ['credit', 'debit'])
                  ->after('user_id')
                  ->default('credit');

            $table->string('description')
                  ->nullable()
                  ->after('type');

            $table->decimal('balance_after', 12, 2)
                  ->default(0)
                  ->after('net_amount');
        });
    }

    public function down(): void
    {
        Schema::table('payouts', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'description',
                'balance_after',
            ]);
        });
    }
};
