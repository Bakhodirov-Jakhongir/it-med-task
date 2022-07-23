<?php

namespace Tests\Feature;

use App\Models\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DoctorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_doctor_test()
    {
        $response = $this->postJson('api/doctors', [
            'name' => 'test doctor name',
            'phone_number' => '998981234561',
            'type' => 'GENERAL_DOCTOR',
            'experience' => 2
        ]);

        $response->assertStatus(201);
    }

    public function test_validation_rule()
    {
        $response = $this->postJson('api/doctors', [
            'name' => 'doctor name',
            'phone_number' => '+998931000101',
            'address' => 'address-patient',
            'type' => 1,
            'experience' => '2.5 years'
        ]);
        $response->assertStatus(422);
    }

    public function test_delete_patient_test()
    {
        $doctor = Doctor::create([
            'name' => 'test name',
            'phone_number' => '998901234567',
            'type' => 'INTERNIST',
            'experience' => 2
        ]);
        $response = $this->deleteJson(route('doctors.destroy', [$doctor->id]));
        $response->assertStatus(204);
        $this->assertModelMissing($doctor);
    }
}
