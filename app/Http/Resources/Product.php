<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    public static $wrap = 'data';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => "products",
            "id" => $this->id,
            "attributes" => [
                "name" => $this->name,
                "price" => $this->price
            ],
            "links" => [
                'self' => route('productos.show', [$this])
            ]
        ];
    }
}
