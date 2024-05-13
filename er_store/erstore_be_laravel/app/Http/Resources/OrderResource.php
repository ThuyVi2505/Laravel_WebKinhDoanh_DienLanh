<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'code' => $this->code,
            'total_amount' => $this->total_amount,
            'address_ship' => $this->address_ship,
            // 'thumnail' => $this->thumnail,
            'created_at' => $this->created_at->format('H:i:s d/m/Y'),
            // 'updated_at' => $this->updated_at->format('H:i:s d/m/Y'),
        ];
    }
}
