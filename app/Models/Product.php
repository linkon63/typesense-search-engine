<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    use Searchable;

    protected $table = "products";

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'sku',
        'is_active',
        'category_id',
        'image_path'
    ];

    public function toSearchableArray()
    {
        return array_merge($this->toArray(), [
            "name" => (string) $this->name,
            "description" => $this->description,
            "quantity" => $this->quantity,
            "is_active" => (string) $this->is_active,
        ]);
    }

    public function searchableAs(): string
    {
        return 'products';
    }

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Uncategorized'
        ]);
    }

    // Scope for active products
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for products in stock
    public function scopeInStock($query)
    {
        return $query->where('quantity', '>', 0);
    }

    // Accessor for formatted price
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2);
    }
}