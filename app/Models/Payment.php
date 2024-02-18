<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $attributes = [
        'amount' => 0,
        'paymentdate' => 'current_timestamp',
        'paymentstatus' => 'pending',
        'member_id' => 0,
    ];

    public function Member()
    {
        return $this->belongsTo(Member::class);
    }
}
