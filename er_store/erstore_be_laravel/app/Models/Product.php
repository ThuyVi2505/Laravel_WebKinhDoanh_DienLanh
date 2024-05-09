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
        'prod_description',
        'prod_model',
        'origin_country',
        'guarantee_period',
        'brand_id',
        'cat_id',
        'isActive',
    ];
    public $timestamps = false;

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'prod_attr_value')->withPivot('value');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'prod_id', 'id');
    }
    public function sale()
    {
        return $this->hasOne(SaleProd::class, 'product_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id','id');
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'product_id','id');
    }

    // Phương thức kiểm tra sản phẩm có tồn tại trong bảng order_details không
    public function hasOrderDetails()
    {
        return $this->order_details()->exists();
    }
}
