<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\OrderStatus;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'tool_id',
        'course_id',
        'amount',
        'status',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    /**
     * Buyer of the tool/course
     */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * If this order is for a tool
     */
    public function tool()
    {
        return $this->belongsTo(Tool::class, 'tool_id');
    }

    /**
     * If this order is for a course
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get the creator of the purchased product
     */
    public function creator()
    {
        if ($this->tool_id) {
            return $this->tool?->creator; // property, not method
        }
        if ($this->course_id) {
            return $this->course?->creator; // property, not method
        }
        return null;
    }


    /**
     * Determine if order is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === OrderStatus::COMPLETED;
    }
}
