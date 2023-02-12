<?php

namespace App\Http\Resources;

use App\Models\Movie;
use App\Models\Reviewer;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'id'=>$this->resource->id,
            'reviewer'=>Reviewer::find($this->resource->reviewer_id),
            'movie'=>Movie::find($this->resource->movie_id),
            'rating'=>$this->resource->rating,
            'comment'=>$this->resource->comment
        ];
    }
}
