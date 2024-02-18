<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function salesLineItems(): HasMany
    {
        return $this->hasMany(SalesLineItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    // Additional methods/properties:

    public function getTotalAmount(): float
    {
        // Calculate total amount using sales line items
        return $this->salesLineItems->sum('subtotal');
    }

    public function getFormattedDate(): string
    {
        // Format date for display
        return $this->date->format('Y-m-d H:i:s');
    }
}
