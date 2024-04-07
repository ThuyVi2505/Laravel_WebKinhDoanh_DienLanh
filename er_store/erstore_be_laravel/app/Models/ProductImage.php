<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'image',
        'prod_id',
    ];
    public $timestamps = false;

    public function products()
    {
        return $this->belongsTo(Product::class, 'prod_id','id');
    }
}

