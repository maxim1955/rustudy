<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'img_path' => $this->img,
            'img_alt' => $this->imgAlt,
            'img_title' => $this->imgTitle,
            'title' => $this->title,
            'brief' => $this->brief,
            'content' => $this->content,
            'location' => $this->location,
            'place' => $this->place,
            'sponsor' => $this->sponsor,
            'date' => $this->date
        ];
    }
}
