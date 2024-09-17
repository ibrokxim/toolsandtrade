<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Main extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo', 'phone', 'address', 'mail', 'email_address'
    ];
}
