<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payouts', function (Blueprint $table) {

            $table->foreignId('order_id')
                ->nullable()
                ->after('user_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->decimal('platform_fee', 10, 2)
                ->default(0)
                ->after('amount');

            $table->decimal('net_amount', 10, 2)
                ->default(0)
                ->after('platform_fee');

            $table->string('reference')
                ->nullable()
                ->after('method');

            $table->timestamp('paid_at')
                ->nullable()
                ->after('reference');
        });
    }

    public function down(): void
    {
        Schema::table('payouts', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn([
                'order_id',
                'platform_fee',
                'net_amount',
                'reference',
                'paid_at',
            ]);
        });
    }
};
