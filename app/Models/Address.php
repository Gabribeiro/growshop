<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'address1',
        'address2',
        'country',
        'city',
        'default',
        'company',        
        'postal',
        'user_id'
    ];

    // Definir atributos padrão para campos nullable
    protected $attributes = [
        'address2' => '',
        'postal' => ''
    ];
}
