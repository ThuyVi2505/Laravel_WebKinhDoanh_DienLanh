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

    // relationship with its self
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
    //product
    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id','id');
    }
    public function hasAnyChild(){
        return $this->children->count()>0;
    }
    public function hasProducts()
    {
        return $this->products()->exists();
    }

    public function hasAnyProducts()
    {
        if ($this->hasProducts()) {
            return true;
        }

        foreach ($this->children as $child) {
            if ($child->hasProducts()) {
                return true;
            }
        }

        return false;
    }
    // Phương thức đệ quy để lấy danh sách sản phẩm của danh mục và các danh mục con
    public function getAllProducts()
    {
        $products = $this->products;

        // Lặp qua các danh mục con (children) và gọi đệ quy để lấy danh sách sản phẩm của chúng
        foreach ($this->children as $child) {
            $products = $products->merge($child->getAllProducts());
        }

        return $products;
    }
}
