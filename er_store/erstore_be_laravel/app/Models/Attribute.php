<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attributes';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'key',
    ];
    public $timestamps = false;
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'prod_attr_value')->withPivot('value');
    }
}
