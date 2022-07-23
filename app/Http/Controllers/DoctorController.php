<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Http\Requests\Doctor\CreateDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Http\Resources\Doctor\GetDoctorsResource;
use App\Repositories\Interfaces\DoctorRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    private DoctorRepositoryInterface $doctorRepository;

    public function __construct(DoctorRepositoryInterface $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = $this->doctorRepository->getAll();
        return GetDoctorsResource::collection($doctors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDoctorRequest $request)
    {
        DB::beginTransaction();
        try {
            $doctor = $this->doctorRepository->create($request);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 422);
        }
        DB::commit();
        return new GetDoctorsResource($doctor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return new GetDoctorsResource($doctor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        DB::beginTransaction();
        try {
            $updated_doctor = $this->doctorRepository->update($request, $doctor);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 422);
        }
        DB::commit();
        return new GetDoctorsResource($updated_doctor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        try {
            $this->doctorRepository->delete($doctor);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 422);
        }
        return response()->json([], 204);
    }
}
