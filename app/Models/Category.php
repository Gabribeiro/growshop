<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
        'sort_order'
    ];

    /**
     * Obtém os produtos associados a esta categoria.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
