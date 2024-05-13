<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'brand_name' => $this->brand_name,
            'brand_slug' => $this->brand_slug,
            'thumnail' => asset('storage/uploads/Brand/'.$this->thumnail),
            // 'created_at' => $this->created_at->format('H:i:s d/m/Y'),
            // 'updated_at' => $this->updated_at->format('H:i:s d/m/Y'),
          ];
    }
}
