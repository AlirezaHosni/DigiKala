<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'icon', 'logo', 'keywords', 'approved', 'status'
    ];

    protected $casts = ['logo' => 'array', 'icon' => 'array'];
}
