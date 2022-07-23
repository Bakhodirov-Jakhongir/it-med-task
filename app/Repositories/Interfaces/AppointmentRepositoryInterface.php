<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Appointment\CreateAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Support\Collection;

interface AppointmentRepositoryInterface
{
    public function getAll(): Collection;
    public function create(CreateAppointmentRequest $request): Appointment;
    public function update(UpdateAppointmentRequest $request, Appointment $appointment): Appointment;
    public function delete(Appointment $appointment): void;
}
