<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'product_num'=>$this->product_num,
            'product_bar'=>$this->product_bar,
            'product_name'=>$this->product_name,
            'product_ed'=>$this->product_skt
        ];
    }
}
