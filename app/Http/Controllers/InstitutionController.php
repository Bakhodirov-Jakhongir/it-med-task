<?php

namespace App\Http\Controllers;

use App\Http\Requests\Institution\CreateInstitutionRequest;
use App\Http\Requests\Institution\UpdateInstitutionRequest;
use App\Models\Institution;
use Illuminate\Http\Request;
use App\Http\Resources\Institution\GetInstitutionsResource;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::with('appointments')->get();
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
        $institution = Institution::create([
            'name' => $request->name,
            'address' => $request->address
        ]);
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
        if ($request->has('name')) {
            $institution->name = $request->name;
        }

        if ($request->has('address')) {
            $institution->address = $request->address;
        }
        $institution->save();
        return new GetInstitutionsResource($institution);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution)
    {
        $institution->delete();
        return response()->json([], 204);
    }
}
