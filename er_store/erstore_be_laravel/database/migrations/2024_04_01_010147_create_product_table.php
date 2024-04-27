<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('prod_name', 255);
            $table->string('prod_slug', 255);
            $table->bigInteger('prod_price');//->giá
            $table->bigInteger('prod_stock');//->số lượng kho
            $table->longText('prod_description')->nullable();
            $table->string('origin_country')->nullable();//->nguồn gốc xuất xứ
            $table->string('guarantee_period')->nullable();//->thời gian bảo hành

            $table->Integer('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');

            $table->Integer('cat_id')->unsigned()->nullable();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('set null');

            $table->tinyInteger('isActive')->default('0');

            $table->unique('prod_name');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
