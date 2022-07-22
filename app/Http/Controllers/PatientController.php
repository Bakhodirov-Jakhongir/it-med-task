<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\Patient\CreatePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Http\Resources\Patient\GetPatientsResource;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::with('appointments')->get();
        return GetPatientsResource::collection($patients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePatientRequest $request)
    {
        $patient = Patient::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);
        return (new GetPatientsResource($patient))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return new GetPatientsResource($patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
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
        return new GetPatientsResource($patient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json([], 204);
    }
}
