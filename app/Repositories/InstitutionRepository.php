<?php

namespace App\Repositories;

use App\Http\Requests\Institution\CreateInstitutionRequest;
use App\Http\Requests\Institution\UpdateInstitutionRequest;
use App\Models\Institution;
use App\Repositories\Interfaces\InstitutionRepositoryInterface;
use Illuminate\Support\Collection;

class InstitutionRepository implements InstitutionRepositoryInterface
{
    public function getAll(): Collection
    {
        $institutions = Institution::with('appointments')->get();
        return $institutions;
    }

    public function create(CreateInstitutionRequest $request): Institution
    {
        $institution = Institution::create([
            'name' => $request->name,
            'address' => $request->address
        ]);
        return $institution;
    }

    public function update(UpdateInstitutionRequest $request, Institution $institution): Institution
    {
        if ($request->has('name')) {
            $institution->name = $request->name;
        }

        if ($request->has('address')) {
            $institution->address = $request->address;
        }
        $institution->save();
        return $institution;
    }

    public function delete(Institution $institution): void
    {
        $institution->delete();
    }
}
