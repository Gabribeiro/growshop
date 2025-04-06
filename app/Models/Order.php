<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_method',
        'total_price',
        'is_paid',
        'shipping_id',
        'paid_at',
        'is_delivered',
        'delivered_at',
        'status',
        'user_email'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
                    ->withPivot(['quantity', 'print_type', 'print_text', 'print_font', 'print_color', 'print_image']); // Inclua os campos adicionais aqui
    }    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
