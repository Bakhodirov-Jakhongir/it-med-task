<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Institution;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_patient_test()
    {
        $doctor_id = $this->getId(new Doctor());
        $patient_id = $this->getId(new Patient());
        $institution_id = $this->getId(new Institution());

        $response = $this->postJson('api/appointments', [
            'title' => 'title appointment',
            'description' => 'description appointment',
            'doctor_id' => $doctor_id,
            'patient_id' => $patient_id,
            'institution_id' => $institution_id
        ]);
        $response->assertStatus(201);
    }

    public function test_validation_appointment_test()
    {
        $response = $this->postJson('api/appointments', []);
        $response->assertStatus(422);
    }

    public function test_delete_appointment_test()
    {
        $appointment = Appointment::inRandomOrder()->first();
        $response = $this->deleteJson(route('appointments.destroy', [$appointment->id]));
        $response->assertStatus(204);
        $this->assertModelMissing($appointment);
    }

    public function getId(Model $model)
    {
        return $model->inRandomOrder()->first()->id;
    }
}
