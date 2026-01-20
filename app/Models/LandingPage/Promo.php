<?php

namespace App\Models\LandingPage;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'item_promo';

    protected $fillable = [
        'title',
        'description',
        'category',
        'image_path',
        'price_before_promo',
        'price_after_promo',
    ];
}
