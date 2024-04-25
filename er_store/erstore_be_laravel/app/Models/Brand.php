<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($brand) {
            // Xóa hình ảnh khi xóa brand
            if ($brand->image) {
                // Lấy đường dẫn đến file ảnh từ trường image của brand
                $imagePath = public_path($brand->thumnail);

                // Kiểm tra xem file tồn tại trước khi xóa
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Xóa file ảnh
                }
            }
        });
    }
    
    // public function book(): belongsToMany{
    //     return $this->belongsToMany(Book::class);
    // };
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
