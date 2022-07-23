<?php

namespace App\Repositories;

use App\Models\Patient;
use Illuminate\Support\Collection;
use App\Http\Requests\Patient\CreatePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Repositories\Interfaces\PatientRepositoryInterface;

class PatientRepository  implements PatientRepositoryInterface
{
    public function getAll(): Collection
    {
        $patients = Patient::with('appointments')->get();
        return $patients;
    }

    public function create(CreatePatientRequest $request): Patient
    {
        $patient = Patient::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);
        return $patient;
    }

    public function update(UpdatePatientRequest $request, Patient $patient): Patient
    {
        if ($request->has('name')) {
            $patient->name = $request->name;
        }

        if ($request->has('address')) {
            $patient->address = $request->address;
        }

        if ($request->has('phone_number')) {
            $patient->phone_number = $request->phone_number;
        }
        $patient->save();
        return $patient;
    }

    public function delete(Patient $patient): void
    {
        $patient->delete();
    }
}
