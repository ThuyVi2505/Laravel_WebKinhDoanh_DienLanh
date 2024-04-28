<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        $productRoutes = [
            'brand.index', // Tên các route bạn muốn kiểm tra
            'category.index',
            'product.index',
            'attribute.index',
            // Thêm các tên route khác nếu cần
            'category.create',
            'brand.create',
            'product.create',

            'category.edit',
            'brand.edit',
            'product.edit',
        ];

        View::share('productRoutes', $productRoutes);
    }
}
