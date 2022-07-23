<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\CreateAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Http\Resources\Appointment\GetAppointmentsResource;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::with(['doctor', 'patient', 'institution'])->get();
        return GetAppointmentsResource::collection($appointments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAppointmentRequest $request)
    {
        $appointment = Appointment::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'institution_id' => $request->institution_id,
            'title' => $request->title,
            'description' => $request->description
        ]);
        return new GetAppointmentsResource($appointment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return new GetAppointmentsResource($appointment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        if ($request->has('doctor_id')) {
            $appointment->doctor_id = $request->doctor_id;
        }

        if ($request->has('patient_id')) {
            $appointment->patient_id = $request->patient_id;
        }

        if ($request->has('institution_id')) {
            $appointment->institution_id = $request->institution_id;
        }

        if ($request->has('title')) {
            $appointment->title = $request->title;
        }

        if ($request->has('description')) {
            $appointment->description = $request->description;
        }

        $appointment->save();
        return new GetAppointmentsResource($appointment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response()->json([], 204);
    }
}
