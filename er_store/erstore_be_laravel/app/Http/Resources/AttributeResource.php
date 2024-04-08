<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $values = $this->values->pluck('value')->toArray();

        return count($values) === 1 ? $values[0] : $values;

    }
    protected function values()
    {
        return $this->resource->products->groupBy('key')->map(function ($product) {
            return $product->pluck('pivot.value')->first();
        });
    }
}
