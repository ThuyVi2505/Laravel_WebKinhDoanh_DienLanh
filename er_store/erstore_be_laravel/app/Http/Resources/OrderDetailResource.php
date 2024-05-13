<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'order_id'=>$this->order_id,
            'order_code'=> $this->order->code,
            'product_id'=> $this->product_id,
            'percent_sale' => $this->percent_sale,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'total' => $this->total_price,
            // 'thumnail' => $this->thumnail,
            // 'created_at' => $this->created_at->format('H:i:s d/m/Y'),
            // 'updated_at' => $this->updated_at->format('H:i:s d/m/Y'),
        ];
    }
}
