<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProd extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'sale_products';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'product_id',
        'percent',
    ];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
