<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'condition' => $this->condition,
            // 'manufacturer' => $this->manufacturer->name,
            'car_model' => $this->car_model,
            'year' => $this->year,
            'price' => $this->price,
            // 'build_type' => $this->buildType->name,
            'engine_power' => $this->engine_power,
            'transmission' => $this->transmission,
            'gear' => $this->gear,
            'mileage' => $this->mileage,
            'trim_name' => $this->trim_name,
            'steering_position' => $this->steering_position,
            'fuel_type' => $this->fuel_type,
            'color' => $this->color,
            'vin' => $this->vin,
            'plate_number' => $this->plate_number,
            'licence_status' => $this->licence_status,
            'plate_color' => $this->plate_color,
            // 'plate_division' => isset($this->plate_division->name) ? $this->plate_division->name : null,
            'seat' => $this->seat,
            'door' => $this->door,
            'owner_count' => $this->owner_count,
            'description' => $this->description,
            'phone' => $this->phone,
            'address' => $this->address,
            'isPublic' => $this->is_published,
            'published_at' => $this->published_at,
            'isFavorite' => $this->isFavourite(),
            'user' => new UserResource($this->user),
            'manufacturer' => new ManufacturerResource($this->manufacturer),
            'build_type' => new BuildTypeResource($this->buildType),
            'plate_division' => new PlateDivisionResource($this->plateDivision),
            'images' => isset($this->images[0]) ? $this->images->map(function ($image) {
                return [
                    'url' => Storage::url($image->path) . '/' . $image->name,
                ];
            }) : [["url" => url("/images/no_image_available.png")]],
        ];
    }
}
