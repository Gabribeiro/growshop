<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'active',
        'stock',
        'sku',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($component) {
            if (empty($component->slug)) {
                $component->slug = Str::slug($component->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(ComponentCategory::class, 'category_id');
    }

    public function kits()
    {
        return $this->belongsToMany(Kit::class, 'component_kit')
                    ->withPivot('quantity');
    }
}
