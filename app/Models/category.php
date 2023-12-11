<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];
    public $timestamps = true;

    public function products() {
        return $this->belongsToMany(Product::class, 'product_categories');
    }

}
