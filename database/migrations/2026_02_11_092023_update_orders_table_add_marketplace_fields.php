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

            $table->foreignId('creator_id')
                ->after('buyer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->decimal('platform_fee', 10, 2)
                ->default(0)
                ->after('amount');

            $table->string('payment_reference')
                ->nullable()
                ->after('status');

            $table->timestamp('paid_at')
                ->nullable()
                ->after('payment_reference');

            $table->timestamp('released_at')
                ->nullable()
                ->after('paid_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // Drop foreign key first
            $table->dropForeign(['creator_id']);

            // Then drop columns
            $table->dropColumn([
                'creator_id',
                'platform_fee',
                'payment_reference',
                'paid_at',
                'released_at',
            ]);
        });
    }
};
