<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        // return parent::toArray($request);
        return [
        "id" => $this->id,
        "title" => $this->title,
        // "status" => $this->status,
        // "user_id" => $this->user_id,
        // "created_at" => $this->created_at,
        // "updated_at" => $this->updated_at,
        "album" => $this->album,
        "generous" => $this->generous,
        "artist" => $this->artist,
        "favorite" => $this->favorite,
        "lyrics" => $this->lyrics,
        ];
    }
}
