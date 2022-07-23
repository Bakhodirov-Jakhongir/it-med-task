<?php

namespace App\Http\Resources\Appointment;

use App\Http\Resources\Doctor\GetDoctorsResource;
use App\Http\Resources\Institution\GetInstitutionsResource;
use App\Http\Resources\Patient\GetPatientsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAppointmentsResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'doctor' => new GetDoctorsResource($this->doctor),
            'patient' => new GetPatientsResource($this->patient),
            'institution' => new GetInstitutionsResource($this->institution),
        ];
    }
}
