<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'active',
        'stock',
        'sku',
        'slug',
        'components',
    ];

    protected $casts = [
        'components' => 'array',
        'active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kit) {
            if (empty($kit->slug)) {
                $kit->slug = Str::slug($kit->name);
            }
        });
    }

    public function components()
    {
        return $this->belongsToMany(Component::class, 'component_kit')
                    ->withPivot('quantity');
    }
}
