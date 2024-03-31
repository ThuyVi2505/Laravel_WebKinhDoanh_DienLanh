<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'cat_name',
        'cat_slug',
        'parent_id',
        'isActive',
    ];
    public $timestamps = false;

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
}
