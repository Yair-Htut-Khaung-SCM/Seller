<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->profile->status,
            'phone' => $this->profile->phone,
            'address' => $this->profile->address,
            'description' => $this->profile->description,
            'created_at' => $this->created_at->toDateString(),
            'image' => $this->profile->profile_image ? Storage::url('/' . $this->profile->profile_image->path . '/' . $this->profile->profile_image->name) : null,
        ];
    }
}
