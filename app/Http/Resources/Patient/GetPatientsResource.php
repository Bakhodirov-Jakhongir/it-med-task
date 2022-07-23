<?php

namespace App\Http\Resources\Patient;

use App\Http\Resources\Appointment\GetAppointmentsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GetPatientsResource extends JsonResource
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
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'appointments' => $this->appointments
        ];
    }
}
