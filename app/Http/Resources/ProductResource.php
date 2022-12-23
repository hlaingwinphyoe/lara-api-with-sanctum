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

    public function stockStatus($stock){
        $status = "";
        if ($stock > 20){
            $status = "available";
        }elseif($stock < 20){
            $status = "few";
        }elseif($stock === 0){
            $status = "out of stock";
        }

        return $status;
    }

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "show_price" => $this->price." MMK",
            "stock" => $this->stock,
            "stock_status" => $this->stockStatus($this->stock),
            "date" => $this->created_at->format("d M Y"),
            "time" => $this->created_at->format("h:i A"),
//            "owner" => $this->user->name
            "owner" => new UserResource($this->user),
            "photos" => PhotoResource::collection($this->photos)
        ];
    }
}
