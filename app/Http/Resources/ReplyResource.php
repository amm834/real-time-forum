<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'reply' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'name' => $this->user->name,
            'user_id' => $this->user->id,
            'question_slug' => $this->question->slug,
            'total_like' => $this->likes()->count(),
            'isLiked' => !! $this->likes()->where('user_id', $this->user->id)->count()
        ];
    }
}
