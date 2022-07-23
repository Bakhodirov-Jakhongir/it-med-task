<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Resources\Json\JsonResource;

class GetDoctorsResource extends JsonResource
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
            'type' => $this->type,
            'experience' => $this->experience,
            'phone_number' => $this->phone_number,
            'appointments' => $this->appointments
        ];
    }
}
