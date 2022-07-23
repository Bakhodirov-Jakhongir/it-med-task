<?php

namespace App\Repositories;


use App\Models\Doctor;
use Illuminate\Support\Collection;
use App\Http\Requests\Doctor\CreateDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Repositories\Interfaces\DoctorRepositoryInterface;

class DoctorRepository implements DoctorRepositoryInterface
{
    public function getAll(): Collection
    {
        $doctors = Doctor::with('appointments')->get();
        return $doctors;
    }

    public function create(CreateDoctorRequest $request): Doctor
    {
        $doctor = Doctor::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'type' => $request->type,
            'experience' => $request->experience
        ]);
        return $doctor;
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor): Doctor
    {
        if ($request->has('name')) {
            $doctor->name = $request->name;
        }

        if ($request->has('phone_number')) {
            $doctor->phone_number = $request->phone_number;
        }

        if ($request->has('type')) {
            $doctor->type = $request->type;
        }

        if ($request->has('experience')) {
            $doctor->experience = $request->experience;
        }
        $doctor->save();
        return $doctor;
    }

    public function delete(Doctor $doctor): void
    {
        $doctor->delete();
    }
}
