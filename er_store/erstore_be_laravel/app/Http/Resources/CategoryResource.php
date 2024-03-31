<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'cat_name' => $this->cat_name,
            'cat_slug' => $this->cat_slug,
            'parent_id' => $this->parent_id,
            // 'thumnail' => $this->thumnail,
            'created_at' => $this->created_at->format('H:i:s d/m/Y'),
            'updated_at' => $this->updated_at->format('H:i:s d/m/Y'),
        ];
    }
}
