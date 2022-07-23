<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Doctor\CreateDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Models\Doctor;
use Illuminate\Support\Collection;

interface DoctorRepositoryInterface
{
    public function getAll(): Collection;
    public function create(CreateDoctorRequest $request): Doctor;
    public function update(UpdateDoctorRequest $request, Doctor $doctor): Doctor;
    public function delete(Doctor $doctor): void;
}
