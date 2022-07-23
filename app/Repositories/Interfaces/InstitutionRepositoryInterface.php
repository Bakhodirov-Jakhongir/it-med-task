<?php

namespace App\Repositories\Interfaces;

use App\Models\Institution;
use Illuminate\Support\Collection;
use App\Http\Requests\Institution\CreateInstitutionRequest;
use App\Http\Requests\Institution\UpdateInstitutionRequest;

interface InstitutionRepositoryInterface
{
    public function getAll(): Collection;
    public function create(CreateInstitutionRequest $request): Institution;
    public function update(UpdateInstitutionRequest $request, Institution $institution): Institution;
    public function delete(Institution $institution): void;
}
