<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'brand_name',
        'brand_slug',
        'thumnail',
        'isActive',
    ];
    public $timestamps = false;
    
    // public function book(): belongsToMany{
    //     return $this->belongsToMany(Book::class);
    // };
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
