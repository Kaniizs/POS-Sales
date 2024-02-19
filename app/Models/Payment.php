<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $attributes = [
        'member_id' => null,
        'paymentstatus' => 'pending',
    ];

    public function Member()
    {
        return $this->belongsTo(Member::class);
    }
}
