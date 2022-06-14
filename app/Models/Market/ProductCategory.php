<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'show_in_menu',
        'parent_id',
        'status',
        'tags',
    ];

    protected $casts = ['image' => 'array'];

    public function sluggable(): array
    {
        return
            ['slug' =>[
                'source' => 'name'
            ]];
    }

    public function parent()
    {
        return $this->belongsToMany($this, 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id')->with('children');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function attributes()
    {
        return $this->hasMany(CategoryAttributes::class);
    }


}
