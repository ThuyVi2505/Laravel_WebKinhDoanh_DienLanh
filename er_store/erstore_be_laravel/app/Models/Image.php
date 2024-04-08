<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'prod_id',
        'image',
    ];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }
}

