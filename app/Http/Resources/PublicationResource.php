<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicationResource extends JsonResource
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
            'title' => $this->title,
            'brief' => $this->brief,
            'content' => $this->content,
            'source' => $this->source,
            'published_at' => $this->published_at
        ];
    }
}
