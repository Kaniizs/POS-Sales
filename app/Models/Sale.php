<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;

    protected $attributes = [
        'date' => 'current_timestamp',
    ];

    public function sales_lines_items(): HasMany
    {
        return $this->hasMany(SalesLineItem::class);

    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
