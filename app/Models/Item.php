<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $attributes = [
        "name" => "Item Name",
        "description" => "Item Description",
        "price" => 0
    ];

    public function sales_line_items(): HasMany
    {
        return $this->hasMany(SalesLineItem::class);
    }
    
}