<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'prod_name',
        'prod_slug',
        'prod_price',
        'prod_stock',
        'isActive',
    ];
    public $timestamps = false;

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'prod_attr_value')->withPivot('value');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'prod_id','id');
    }
}
