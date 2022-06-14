<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'unit', 'category_type'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
