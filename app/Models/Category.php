<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['shop_id', 'name', 'path'];

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    use HasFactory;
}
