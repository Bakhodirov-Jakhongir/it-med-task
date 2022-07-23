<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Http\Requests\Institution\CreateInstitutionRequest;
use App\Http\Requests\Institution\UpdateInstitutionRequest;
use App\Http\Resources\Institution\GetInstitutionsResource;
use App\Repositories\Interfaces\InstitutionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class InstitutionController extends Controller
{
    private InstitutionRepositoryInterface $institutionRepository;

    public function __construct(InstitutionRepositoryInterface $institutionRepository)
    {
        $this->institutionRepository = $institutionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = $this->institutionRepository->getAll();
        return GetInstitutionsResource::collection($institutions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInstitutionRequest $request)
    {
        DB::beginTransaction();
        try {
            $institution = $this->institutionRepository->create($request);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 422);
        }
        DB::commit();
        return new GetInstitutionsResource($institution);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show(Institution $institution)
    {
        return new GetInstitutionsResource($institution);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstitutionRequest $request, Institution $institution)
    {
        try {
            $updated_institution = $this->institutionRepository->update($request, $institution);
        } catch (\Throwable $th) {
            DB::beginTransaction();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 422);
        }
        return new GetInstitutionsResource($updated_institution);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution)
    {
        try {
            $this->institutionRepository->delete($institution);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 422);
        }
        return response()->json([], 204);
    }
}
