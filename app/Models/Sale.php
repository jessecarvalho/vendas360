<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'value',
        'date',
        'commission',
        "seller_id"
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo('App\Models\Seller', 'seller_id');
    }

    use HasFactory;
}
