<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\PayoutStatus;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
    ];

    protected $casts = [
        'status' => PayoutStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
