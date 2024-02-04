<?php

namespace App\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{

    protected $fillable = [
        'name',
        'email',
    ];

    public function sales() : HasMany
    {
        return $this->hasMany(Sale::class, 'seller_id');
    }

    use HasFactory;
}
