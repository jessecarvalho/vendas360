<?php

namespace App\Models;

use App\Models2\Sales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sellers extends Model
{
    protected $fillable = [
        'name',
        'email',
    ];

    public function sales() : HasMany
    {
        return $this->hasMany(Sales::class, 'seller_id');
    }

    use HasFactory;
}
