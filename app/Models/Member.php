<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $attributes = [
        'name' => 'John Doe',
        'phone' => '123-456-7890',
    ];
}
