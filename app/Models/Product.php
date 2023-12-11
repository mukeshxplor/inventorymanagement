<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','price','quantity'];
    public $timestamps = true;


    
    public function categories() {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

}