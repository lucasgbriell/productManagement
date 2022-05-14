<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $hidden = ["category_id"];

    protected $fillable = ["description", "category_id", "code", "reference", "quantity", "price", "is_active"];

    public function dimension(){
        return $this->hasMany(ProductDimension::class);
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
