<?php

namespace App\Repositories;

use App\Http\Requests\Appointment\CreateAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Repositories\Interfaces\AppointmentRepositoryInterface;
use Illuminate\Support\Collection;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    public function getAll(): Collection
    {
        $appointments = Appointment::with(['doctor', 'patient', 'institution'])->get();
        return $appointments;
    }

    public function create(CreateAppointmentRequest $request): Appointment
    {
        $appointment = Appointment::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'institution_id' => $request->institution_id,
            'title' => $request->title,
            'description' => $request->description
        ]);
        return $appointment;
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): Appointment
    {
        if ($request->has('doctor_id')) {
            $appointment->doctor_id = $request->doctor_id;
        }

        if ($request->has('patient_id')) {
            $appointment->patient_id = $request->patient_id;
        }

        if ($request->has('institution_id')) {
            $appointment->institution_id = $request->institution_id;
        }

        if ($request->has('title')) {
            $appointment->title = $request->title;
        }

        if ($request->has('description')) {
            $appointment->description = $request->description;
        }

        $appointment->save();
        return $appointment;
    }

    public function delete(Appointment $appointment): void
    {
        $appointment->delete();
    }
}
