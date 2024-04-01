<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->id,
            'prod_name' => $this->prod_name,
            'prod_slug' => $this->prod_slug,
            'prod_price' => $this->prod_price,
            'prod_stock' => $this->prod_stock,
            'attributes' => AttributeResource::collection($this->whenLoaded('attributes')),
            // 'thumnail' => $this->thumnail,
            'created_at' => $this->created_at->format('H:i:s d/m/Y'),
            'updated_at' => $this->updated_at->format('H:i:s d/m/Y'),
        ];
    }
}
