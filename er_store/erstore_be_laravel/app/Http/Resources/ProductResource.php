<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AttributeResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $attributesFormatted = [];

        // Lặp qua các thuộc tính của sản phẩm
        foreach ($this->attributes as $attribute) {
            $key = $attribute->key;
            $value = $attribute->pivot->value;

            // Kiểm tra xem key đã có trong mảng attributesFormatted chưa
            if (array_key_exists($key, $attributesFormatted)) {
                // Nếu đã tồn tại key trong mảng, chuyển đổi value thành mảng nếu chưa phải
                if (!is_array($attributesFormatted[$key])) {
                    $attributesFormatted[$key] = [$attributesFormatted[$key]];
                }
                // Thêm value mới vào mảng
                $attributesFormatted[$key][] = $value;
            } else {
                // Nếu key chưa có trong mảng, gán value trực tiếp
                $attributesFormatted[$key] = $value;
            }
        }

        return [
            'id' => $this->id,
            'prod_model' => $this->prod_model,
            'prod_name' => $this->prod_name,
            'prod_slug' => $this->prod_slug,
            'prod_price' => $this->prod_price,
            'sale_percent'=> $this->sale->percent,
            'sale_price'=>$this->prod_price-round($this->sale->percent/100*$this->prod_price),
            'sale_at'=>$this->sale->updated_at->format('H:i:s d/m/Y'),
            // 'sale' => [
            //     'percent'=>$this->sale->percent,
            //     'price'=>$this->prod_price-round($this->sale->percent/100*$this->prod_price)
            // ],
            'prod_stock' => $this->prod_stock,
            'origin_country' => $this->origin_country,
            'guarantee_period' => $this->guarantee_period,
            'brand' =>[
                'id' => $this->brand->id,
                'name' => $this->brand->brand_name,
            ],
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->cat_name,
            ],
            'images' => $this->images->pluck('image')->map(function ($imageUrl) {
                return asset('storage/uploads/Product/'.$this->id.'/'.$imageUrl);
            }),
            'attributes' => $attributesFormatted,

            // 'attributes' =>
            //     $this->attributes->groupBy('key')->map(function ($group) {
            //     return $group->pluck('pivot.value')->unique()->all();
            // }),
            'prod_description' => $this->prod_description,
            'created_at' => $this->created_at->format('H:i:s d/m/Y'),
            'updated_at' => $this->updated_at->format('H:i:s d/m/Y'),
        ];
    }
}
