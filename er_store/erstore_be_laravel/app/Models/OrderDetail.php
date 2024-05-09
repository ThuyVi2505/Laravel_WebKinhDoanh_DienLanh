<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $dates = [
        'created_at',
        // 'updated_at',
    ];
    protected $fillable = [
        'percent_sale',
        'price',
        'quantity',
        'total_price',
        'order_id',
        'product_id'
    ];
    public $timestamps = false;
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id','id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
}
