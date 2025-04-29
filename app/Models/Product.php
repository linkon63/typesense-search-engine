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
        return [
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity, // Make sure to include fields you want searchable
            "is_active" => $this->is_active,
        ];
        // return array_merge($this->toArray(), [
        //     "name" => (string) $this->name,
        //     "description" => $this->description,
        //     "quantity" => $this->quantity,
        //     "is_active" => (string) $this->is_active,
        // ]);
    }

    public function searchableAs(): string
    {
        return 'products';
    }

    public function getCollectionSchema(): array
    {
        return [
            'name' => 'products',
            'fields' => [
                [
                    'name' => 'id',
                    'type' => 'int32',
                ],
                [
                    'name' => 'name',
                    'type' => 'string',
                ],
                [
                    'name' => 'description',
                    'type' => 'string',
                ],
                [
                    'name' => 'quantity',
                    'type' => 'int32',
                ],
                [
                    'name' => 'is_active',
                    'type' => 'bool',
                ],
            ],
            'default_sorting_field' => 'quantity',
        ];

    
    }

    public function typesenseQueryBy(): array
    {
        return 
            ['name', 'description']
        ;
    }
}