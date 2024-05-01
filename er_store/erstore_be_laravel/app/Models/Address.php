<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'user_id',
        'number',
        'street',
        'ward',
        'district',
        'city'
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
