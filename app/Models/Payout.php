<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\PayoutStatus;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',      // Creator receiving the payout
        'order_id',     // Optional: link to the order that generated this payout
        'amount',       // Amount to pay
        'status',       // pending, paid, cancelled
        'method',       // e.g., bank, stripe, paypal
    ];

    protected $casts = [
        'status' => PayoutStatus::class,
    ];

    /**
     * The creator receiving the payout
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Optional: The order that triggered this payout
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Scope: Only paid payouts
     */
    public function scopePaid($query)
    {
        return $query->where('status', PayoutStatus::PAID);
    }

    /**
     * Scope: Only pending payouts
     */
    public function scopePending($query)
    {
        return $query->where('status', PayoutStatus::PENDING);
    }
}
