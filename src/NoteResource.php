<?php

namespace Jam0r85\NovaNotes;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
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
            'id' => $this->id,
            'body' => $this->body,
            'parent' => [
                'id' => $this->parent_id,
                'name' => $this->parent_name,
                'resource_name' => str_plural(strtolower($this->parent_name)),
                'resource_path' => str_plural(strtolower($this->parent_name)) . '/' . $this->id
            ],
            'important' => $this->is_important,
            'created_at' => $this->created_at->diffForHumans(),
            'owner' => [
                'name' => $this->owner->name
            ]
        ];
    }
}
