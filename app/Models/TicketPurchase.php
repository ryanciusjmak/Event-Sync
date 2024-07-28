<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'amount_paid',
    ];

    public function event()
{
    return $this->belongsTo(Event::class);
}

}