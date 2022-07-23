<?php

namespace App\Repositories\Interfaces;

use App\Models\Patient;
use Illuminate\Support\Collection;
use App\Http\Requests\Patient\CreatePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;

interface PatientRepositoryInterface
{
    public function getAll(): Collection;
    public function create(CreatePatientRequest $request): Patient;
    public function update(UpdatePatientRequest $request, Patient $patient): Patient;
    public function delete(Patient $patient): void;
}
