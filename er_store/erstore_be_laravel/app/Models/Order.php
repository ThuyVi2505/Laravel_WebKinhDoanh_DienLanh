<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $dates = [
        'created_at',
        // 'updated_at',
    ];
    protected $fillable = [
        'code',
        'total_amount',
        'address_ship',
        'user_id'
    ];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id','id');
    }
}
